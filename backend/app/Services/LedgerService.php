<?php

namespace App\Services;

use App\Models\LedgerEntry;
use App\Models\PlatformAccount;
use App\Models\WalletBalance;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LedgerService
{
    /**
     * Same-currency peer-to-peer transfer.
     * Creates 2 ledger entries: debit sender, credit recipient.
     */
    public function transfer(
        int $senderId,
        int $recipientId,
        float $amount,
        string $currency,
        string $description = 'P2P Transfer',
        array $metadata = []
    ): string {
        return DB::transaction(function () use ($senderId, $recipientId, $amount, $currency, $description, $metadata) {
            $groupId = (string) Str::uuid();

            // Debit sender
            $senderBalanceAfter = $this->debitUser($senderId, $amount, $currency, $groupId, $description, $metadata);

            // Credit recipient
            $recipientBalanceAfter = $this->creditUser($recipientId, $amount, $currency, $groupId, $description, $metadata);

            // Sync legacy wallet_balances table
            $this->syncWalletBalance($senderId, $currency, $senderBalanceAfter);
            $this->syncWalletBalance($recipientId, $currency, $recipientBalanceAfter);

            // Legacy: sync users.wallet_balance for USD
            if ($currency === 'USD') {
                DB::table('users')->where('id', $senderId)->decrement('wallet_balance', $amount);
                DB::table('users')->where('id', $recipientId)->increment('wallet_balance', $amount);
            }

            return $groupId;
        });
    }

    /**
     * Cross-currency transfer via platform pool.
     * Creates 4 ledger entries:
     *   1. Debit sender in source currency
     *   2. Credit platform pool in source currency
     *   3. Debit platform pool in target currency
     *   4. Credit recipient in target currency
     */
    public function convertAndTransfer(
        int $senderId,
        int $recipientId,
        float $sendAmount,
        string $fromCurrency,
        float $receiveAmount,
        string $toCurrency,
        float $rateUsed,
        array $feeBreakdown = [],
        string $description = 'Cross-currency Transfer'
    ): string {
        return DB::transaction(function () use (
            $senderId, $recipientId, $sendAmount, $fromCurrency,
            $receiveAmount, $toCurrency, $rateUsed, $feeBreakdown, $description
        ) {
            $groupId = (string) Str::uuid();
            $metadata = array_merge($feeBreakdown, [
                'rate_used' => $rateUsed,
                'from_currency' => $fromCurrency,
                'to_currency' => $toCurrency,
            ]);

            // 1. Debit sender in source currency
            $senderBal = $this->debitUser($senderId, $sendAmount, $fromCurrency, $groupId, $description, $metadata);

            // 2. Credit platform pool in source currency
            $this->creditPlatform($fromCurrency, $sendAmount, $groupId, "Pool receive: {$fromCurrency}", $metadata);

            // 3. Debit platform pool in target currency
            $this->debitPlatform($toCurrency, $receiveAmount, $groupId, "Pool send: {$toCurrency}", $metadata);

            // 4. Credit recipient in target currency
            $recipientBal = $this->creditUser($recipientId, $receiveAmount, $toCurrency, $groupId, $description, $metadata);

            // Sync legacy tables
            $this->syncWalletBalance($senderId, $fromCurrency, $senderBal);
            $this->syncWalletBalance($recipientId, $toCurrency, $recipientBal);

            return $groupId;
        });
    }

    /**
     * Fund a user's wallet (external deposit).
     */
    public function fund(int $userId, float $amount, string $currency, string $source = 'External Deposit'): string
    {
        return DB::transaction(function () use ($userId, $amount, $currency, $source) {
            $groupId = (string) Str::uuid();
            $metadata = ['source' => $source];

            // Credit user
            $balanceAfter = $this->creditUser($userId, $amount, $currency, $groupId, "Wallet Funding ({$currency})", $metadata);

            // Debit external (virtual entry for completeness)
            LedgerEntry::create([
                'transaction_group_id' => $groupId,
                'account_id' => 0,
                'account_type' => 'platform',
                'entry_type' => 'debit',
                'amount' => $amount,
                'currency' => $currency,
                'balance_after' => 0,
                'description' => "External deposit: {$source}",
                'reference' => 'LED-' . strtoupper(Str::random(12)),
                'metadata' => $metadata,
            ]);

            // Sync legacy
            $this->syncWalletBalance($userId, $currency, $balanceAfter);
            if ($currency === 'USD') {
                DB::table('users')->where('id', $userId)->increment('wallet_balance', $amount);
            }

            return $groupId;
        });
    }

    /**
     * Payout funds from a user's wallet (external payment).
     */
    public function payout(int $userId, float $amount, string $currency, string $description = 'External Payout', array $metadata = []): string
    {
        return DB::transaction(function () use ($userId, $amount, $currency, $description, $metadata) {
            $groupId = (string) Str::uuid();

            // Debit user
            $balanceAfter = $this->debitUser($userId, $amount, $currency, $groupId, $description, $metadata);

            // Credit external (virtual entry for platform)
            LedgerEntry::create([
                'transaction_group_id' => $groupId,
                'account_id' => 0,
                'account_type' => 'platform',
                'entry_type' => 'credit',
                'amount' => $amount,
                'currency' => $currency,
                'balance_after' => 0,
                'description' => "External payout: {$description}",
                'reference' => 'LED-' . strtoupper(Str::random(12)),
                'metadata' => $metadata,
            ]);

            // Sync legacy
            $this->syncWalletBalance($userId, $currency, $balanceAfter);
            if ($currency === 'USD') {
                DB::table('users')->where('id', $userId)->decrement('wallet_balance', $amount);
            }

            return $groupId;
        });
    }

    /**
     * Currency conversion for the same user (no recipient).
     */
    public function convert(
        int $userId,
        float $sendAmount,
        string $fromCurrency,
        float $receiveAmount,
        string $toCurrency,
        float $rateUsed,
        array $feeBreakdown = []
    ): string {
        return $this->convertAndTransfer(
            $userId, $userId, $sendAmount, $fromCurrency,
            $receiveAmount, $toCurrency, $rateUsed, $feeBreakdown,
            'Currency Conversion'
        );
    }

    /**
     * Get user balance from ledger (derived, not stored).
     */
    public function deriveBalance(int $userId, string $currency): float
    {
        $credits = LedgerEntry::forUser($userId, $currency)
            ->where('entry_type', 'credit')
            ->sum('amount');

        $debits = LedgerEntry::forUser($userId, $currency)
            ->where('entry_type', 'debit')
            ->sum('amount');

        return round($credits - $debits, 4);
    }

    /**
     * Get paginated statement for a user.
     */
    public function getStatement(int $userId, ?string $currency = null, int $perPage = 20)
    {
        $query = LedgerEntry::forUser($userId, $currency)
            ->orderByDesc('created_at');

        return $query->paginate($perPage);
    }

    // ── Private helpers ──────────────────────────────────────

    private function debitUser(int $userId, float $amount, string $currency, string $groupId, string $description, array $metadata): float
    {
        $currentBalance = $this->getUserBalance($userId, $currency);

        if ($currentBalance < $amount) {
            throw new \Exception("Insufficient {$currency} balance. Available: {$currentBalance}, Required: {$amount}");
        }

        $balanceAfter = round($currentBalance - $amount, 4);

        LedgerEntry::create([
            'transaction_group_id' => $groupId,
            'account_id' => $userId,
            'account_type' => 'user',
            'entry_type' => 'debit',
            'amount' => $amount,
            'currency' => $currency,
            'balance_after' => $balanceAfter,
            'description' => $description,
            'reference' => 'LED-' . strtoupper(Str::random(12)),
            'metadata' => $metadata,
        ]);

        return $balanceAfter;
    }

    private function creditUser(int $userId, float $amount, string $currency, string $groupId, string $description, array $metadata): float
    {
        $currentBalance = $this->getUserBalance($userId, $currency);
        $balanceAfter = round($currentBalance + $amount, 4);

        LedgerEntry::create([
            'transaction_group_id' => $groupId,
            'account_id' => $userId,
            'account_type' => 'user',
            'entry_type' => 'credit',
            'amount' => $amount,
            'currency' => $currency,
            'balance_after' => $balanceAfter,
            'description' => $description,
            'reference' => 'LED-' . strtoupper(Str::random(12)),
            'metadata' => $metadata,
        ]);

        return $balanceAfter;
    }

    private function creditPlatform(string $currency, float $amount, string $groupId, string $description, array $metadata): void
    {
        $account = PlatformAccount::forCurrency($currency);
        $account->increment('balance', $amount);

        LedgerEntry::create([
            'transaction_group_id' => $groupId,
            'account_id' => $account->id,
            'account_type' => 'platform',
            'entry_type' => 'credit',
            'amount' => $amount,
            'currency' => $currency,
            'balance_after' => $account->fresh()->balance,
            'description' => $description,
            'reference' => 'LED-' . strtoupper(Str::random(12)),
            'metadata' => $metadata,
        ]);
    }

    private function debitPlatform(string $currency, float $amount, string $groupId, string $description, array $metadata): void
    {
        $account = PlatformAccount::forCurrency($currency);
        $account->decrement('balance', $amount);

        LedgerEntry::create([
            'transaction_group_id' => $groupId,
            'account_id' => $account->id,
            'account_type' => 'platform',
            'entry_type' => 'debit',
            'amount' => $amount,
            'currency' => $currency,
            'balance_after' => $account->fresh()->balance,
            'description' => $description,
            'reference' => 'LED-' . strtoupper(Str::random(12)),
            'metadata' => $metadata,
        ]);
    }

    private function getUserBalance(int $userId, string $currency): float
    {
        // Get from wallet_balances first (fast), fall back to ledger derivation
        $balance = WalletBalance::where('user_id', $userId)
            ->where('currency', $currency)
            ->value('amount');

        return (float) ($balance ?? 0);
    }

    private function syncWalletBalance(int $userId, string $currency, float $newBalance): void
    {
        WalletBalance::updateOrCreate(
            ['user_id' => $userId, 'currency' => $currency],
            ['amount' => $newBalance]
        );
    }
}
