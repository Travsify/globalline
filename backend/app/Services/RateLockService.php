<?php

namespace App\Services;

use App\Models\RateLock;
use App\Models\FeeConfiguration;
use Illuminate\Support\Str;

class RateLockService
{
    protected CurrencyService $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * Lock a rate for a user for 60 seconds.
     *
     * @return RateLock
     */
    public function lock(int $userId, string $from, string $to, float $amount): RateLock
    {
        // Get the base mid-market rate
        $baseRate = $this->currencyService->getRate($from, $to);

        // Get corridor markup
        $feeConfig = FeeConfiguration::forCorridor($from, $to);
        $markupPct = $feeConfig ? (float) $feeConfig->fx_markup_pct : 0.005;

        // Apply markup to rate (makes the rate slightly worse for the user)
        $adjustedRate = $baseRate * (1 + $markupPct);

        return RateLock::create([
            'lock_id' => (string) Str::uuid(),
            'from_currency' => strtoupper($from),
            'to_currency' => strtoupper($to),
            'rate' => $adjustedRate,
            'markup_pct' => $markupPct,
            'expires_at' => now()->addSeconds(60),
            'used' => false,
            'user_id' => $userId,
        ]);
    }

    /**
     * Validate a rate lock.
     *
     * @throws \Exception
     */
    public function validate(string $lockId, int $userId): RateLock
    {
        $lock = RateLock::find($lockId);

        if (!$lock) {
            throw new \Exception('Rate lock not found.');
        }

        if ($lock->user_id !== $userId) {
            throw new \Exception('Rate lock does not belong to this user.');
        }

        if (!$lock->isValid()) {
            throw new \Exception('Rate lock has expired. Please request a new rate.');
        }

        return $lock;
    }

    /**
     * Consume a rate lock (mark as used).
     */
    public function consume(RateLock $lock): void
    {
        $lock->consume();
    }

    /**
     * Cleanup expired locks (call from scheduler).
     */
    public function cleanup(): int
    {
        return RateLock::where('expires_at', '<', now())
            ->where('used', false)
            ->delete();
    }
}
