<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WalletTransaction;
use App\Models\FeeConfiguration;
use App\Services\LedgerService;
use App\Services\RateLockService;
use App\Services\FeeCalculatorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    protected LedgerService $ledger;
    protected RateLockService $rateLock;
    protected FeeCalculatorService $feeCalc;

    public function __construct(
        LedgerService $ledger,
        RateLockService $rateLock,
        FeeCalculatorService $feeCalc
    ) {
        $this->ledger = $ledger;
        $this->rateLock = $rateLock;
        $this->feeCalc = $feeCalc;
    }

    /**
     * GET /wallet/balance — Primary balance endpoint.
     */
    public function getBalance()
    {
        $user = Auth::user();
        return response()->json([
            'balance' => (float) $user->wallet_balance,
            'currency' => 'USD',
        ]);
    }

    /**
     * GET /enterprise/wallets — Multi-currency balances.
     */
    public function getBalances()
    {
        $user = Auth::user();
        $balances = \App\Models\WalletBalance::where('user_id', $user->id)->get();

        if (!$balances->contains('currency', 'USD')) {
            $balances->push(new \App\Models\WalletBalance([
                'currency' => 'USD',
                'amount' => (float) $user->wallet_balance,
            ]));
        }

        return response()->json(['data' => $balances]);
    }

    /**
     * POST /wallet/fund — Fund wallet via ledger.
     */
    public function fundWallet(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'currency' => 'nullable|string|in:USD,NGN,CNY,GBP,EUR,GHS,KES,ZAR',
        ]);

        $user = Auth::user();
        $currency = $request->currency ?? 'USD';
        $amount = (float) $request->amount;

        try {
            $groupId = $this->ledger->fund($user->id, $amount, $currency, 'Manual Deposit');

            $newBalance = \App\Models\WalletBalance::where('user_id', $user->id)
                ->where('currency', $currency)
                ->value('amount');

            return response()->json([
                'message' => 'Wallet funded successfully',
                'balance' => (float) $newBalance,
                'currency' => $currency,
                'transaction_group_id' => $groupId,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * POST /wallet/preview-transfer — Fee breakdown before confirming.
     */
    public function previewTransfer(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'from_currency' => 'required|string|size:3',
            'to_currency' => 'required|string|size:3',
        ]);

        try {
            $breakdown = $this->feeCalc->calculate(
                $request->from_currency,
                $request->to_currency,
                (float) $request->amount
            );

            return response()->json(['data' => $breakdown]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * POST /wallet/lock-rate — Lock a rate for 60 seconds.
     */
    public function lockRate(Request $request)
    {
        $request->validate([
            'from_currency' => 'required|string|size:3',
            'to_currency' => 'required|string|size:3',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();

        try {
            $lock = $this->rateLock->lock(
                $user->id,
                $request->from_currency,
                $request->to_currency,
                (float) $request->amount
            );

            return response()->json([
                'data' => [
                    'lock_id' => $lock->lock_id,
                    'from_currency' => $lock->from_currency,
                    'to_currency' => $lock->to_currency,
                    'rate' => (float) $lock->rate,
                    'markup_pct' => (float) $lock->markup_pct,
                    'expires_at' => $lock->expires_at->toIso8601String(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * POST /wallet/transfer — Execute a transfer (same or cross-currency).
     */
    public function transfer(Request $request)
    {
        $request->validate([
            'recipient_identifier' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'from_currency' => 'required|string|size:3',
            'to_currency' => 'nullable|string|size:3',
            'lock_id' => 'nullable|uuid',
        ]);

        $sender = Auth::user();
        $amount = (float) $request->amount;
        $fromCurrency = strtoupper($request->from_currency);
        $toCurrency = strtoupper($request->to_currency ?? $fromCurrency);

        // Find recipient
        $recipient = \App\Models\User::where('email', $request->recipient_identifier)
            ->orWhere('phone', $request->recipient_identifier)
            ->first();

        if (!$recipient) {
            return response()->json(['message' => 'Recipient not found.'], 404);
        }

        if ($recipient->id === $sender->id) {
            return response()->json(['message' => 'Cannot transfer to yourself.'], 400);
        }

        try {
            // Calculate fees
            $breakdown = $this->feeCalc->calculate($fromCurrency, $toCurrency, $amount);
            $totalDebit = $amount; // Full amount debited from sender

            if ($fromCurrency === $toCurrency) {
                // Same-currency transfer
                $receiveAmount = (float) $breakdown['receive_amount'];

                $groupId = $this->ledger->transfer(
                    $sender->id,
                    $recipient->id,
                    $receiveAmount,
                    $fromCurrency,
                    "Transfer to {$recipient->name}",
                    $breakdown
                );

                // If there's a fee, debit it to the platform
                if ($breakdown['transfer_fee'] > 0) {
                    $this->ledger->transfer(
                        $sender->id,
                        0, // Platform fee collection handled separately
                        $breakdown['transfer_fee'],
                        $fromCurrency,
                        'Transfer fee'
                    );
                }
            } else {
                // Cross-currency transfer — validate rate lock if provided
                $rateUsed = (float) $breakdown['exchange_rate'];

                if ($request->lock_id) {
                    $lock = $this->rateLock->validate($request->lock_id, $sender->id);
                    $rateUsed = (float) $lock->rate;
                    $this->rateLock->consume($lock);
                }

                $receiveAmount = round($breakdown['amount_after_fees'] * $rateUsed, 2);

                $groupId = $this->ledger->convertAndTransfer(
                    $sender->id,
                    $recipient->id,
                    $totalDebit,
                    $fromCurrency,
                    $receiveAmount,
                    $toCurrency,
                    $rateUsed,
                    $breakdown,
                    "Transfer to {$recipient->name}"
                );
            }

            // Notify recipient
            \App\Models\Notification::create([
                'user_id' => $recipient->id,
                'title' => 'Funds Received',
                'message' => "You received {$breakdown['receive_amount']} {$toCurrency} from {$sender->name}.",
                'type' => 'Transaction',
                'is_read' => false,
            ]);

            $senderNewBalance = \App\Models\WalletBalance::where('user_id', $sender->id)
                ->where('currency', $fromCurrency)
                ->value('amount');

            return response()->json([
                'status' => 'success',
                'message' => 'Transfer successful!',
                'data' => [
                    'transaction_group_id' => $groupId,
                    'new_balance' => (float) ($senderNewBalance ?? 0),
                    'currency' => $fromCurrency,
                    'fee_breakdown' => $breakdown,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * POST /wallet/convert — Currency conversion (same user).
     */
    public function convert(Request $request)
    {
        $request->validate([
            'from_currency' => 'required|string|size:3',
            'to_currency' => 'required|string|size:3',
            'amount' => 'required|numeric|min:0.01',
            'lock_id' => 'nullable|uuid',
        ]);

        $user = Auth::user();
        $from = strtoupper($request->from_currency);
        $to = strtoupper($request->to_currency);
        $amount = (float) $request->amount;

        if ($from === $to) {
            return response()->json(['message' => 'Cannot convert to the same currency.'], 400);
        }

        try {
            $breakdown = $this->feeCalc->calculate($from, $to, $amount);
            $rateUsed = (float) $breakdown['exchange_rate'];

            // Use locked rate if provided
            if ($request->lock_id) {
                $lock = $this->rateLock->validate($request->lock_id, $user->id);
                $rateUsed = (float) $lock->rate;
                $this->rateLock->consume($lock);
            }

            $receiveAmount = round($breakdown['amount_after_fees'] * $rateUsed, 2);

            $groupId = $this->ledger->convert(
                $user->id,
                $amount,
                $from,
                $receiveAmount,
                $to,
                $rateUsed,
                $breakdown
            );

            return response()->json([
                'status' => 'success',
                'message' => "Converted {$amount} {$from} to {$receiveAmount} {$to}",
                'data' => [
                    'transaction_group_id' => $groupId,
                    'receive_amount' => $receiveAmount,
                    'rate_used' => $rateUsed,
                    'fee_breakdown' => $breakdown,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * GET /wallet/statement — Ledger-based transaction history.
     */
    public function getStatement(Request $request)
    {
        $user = Auth::user();
        $currency = $request->query('currency');

        $entries = $this->ledger->getStatement($user->id, $currency, 20);

        return response()->json($entries);
    }
}
