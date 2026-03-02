<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyService
{
    /**
     * Base rates (USD as base). Used as fallback when live rates are unavailable.
     * Updated periodically from market data.
     */
    protected array $fallbackRates = [
        'USD' => 1.0,
        'NGN' => 1580.0,
        'CNY' => 7.25,
        'GBP' => 0.79,
        'EUR' => 0.92,
        'GHS' => 15.80,
        'KES' => 153.50,
        'ZAR' => 18.20,
    ];

    /**
     * Get the exchange rate from one currency to another.
     * Tries live rates first, falls back to cached/hardcoded.
     */
    public function getRate(string $from, string $to): float
    {
        $from = strtoupper($from);
        $to = strtoupper($to);

        if ($from === $to) {
            return 1.0;
        }

        // Try cached live rates first (refreshed every 5 minutes)
        $cacheKey = "fx_rate_{$from}_{$to}";
        $cachedRate = Cache::get($cacheKey);

        if ($cachedRate !== null) {
            return (float) $cachedRate;
        }

        // Calculate from USD base rates
        $fromUsd = $this->getUsdRate($from);
        $toUsd = $this->getUsdRate($to);

        if ($fromUsd <= 0) {
            throw new \Exception("Unsupported currency: {$from}");
        }

        $rate = $toUsd / $fromUsd;

        // Cache for 5 minutes
        Cache::put($cacheKey, $rate, 300);

        return $rate;
    }

    /**
     * Get the rate of a currency relative to USD.
     * Tries to fetch live rates from external providers.
     */
    protected function getUsdRate(string $currency): float
    {
        $currency = strtoupper($currency);

        if ($currency === 'USD') {
            return 1.0;
        }

        // Check cache for individual currency rate
        $cached = Cache::get("fx_usd_{$currency}");
        if ($cached !== null) {
            return (float) $cached;
        }

        // Try live rate fetch
        $liveRate = $this->fetchLiveRate($currency);
        if ($liveRate !== null) {
            Cache::put("fx_usd_{$currency}", $liveRate, 300);
            return $liveRate;
        }

        // Fallback to hardcoded
        return $this->fallbackRates[$currency] ?? throw new \Exception("Unsupported currency: {$currency}");
    }

    /**
     * Attempt to fetch a live rate from an external API.
     * Returns the rate of the currency per 1 USD, or null on failure.
     */
    protected function fetchLiveRate(string $currency): ?float
    {
        try {
            // Try exchangerate.host (free tier, no API key required)
            $response = Http::timeout(5)->get('https://open.er-api.com/v6/latest/USD');

            if ($response->successful()) {
                $data = $response->json();
                $rates = $data['rates'] ?? [];
                $rate = $rates[strtoupper($currency)] ?? null;

                if ($rate !== null) {
                    // Cache all rates from this response
                    foreach ($rates as $cur => $r) {
                        Cache::put("fx_usd_{$cur}", (float) $r, 300);
                    }
                    return (float) $rate;
                }
            }
        } catch (\Exception $e) {
            Log::warning("Live FX rate fetch failed: {$e->getMessage()}");
        }

        return null;
    }

    /**
     * Convert an amount between currencies.
     */
    public function convert(float $amount, string $from = 'USD', string $to = 'USD'): float
    {
        $rate = $this->getRate($from, $to);
        return round($amount * $rate, 2);
    }

    /**
     * Get the currency symbol.
     */
    public function getSymbol(string $currency): string
    {
        return match (strtoupper($currency)) {
            'NGN' => '₦',
            'CNY' => '¥',
            'GBP' => '£',
            'EUR' => '€',
            'GHS' => 'GH₵',
            'KES' => 'KSh',
            'ZAR' => 'R',
            'USD' => '$',
            default => '$',
        };
    }

    /**
     * Get available currencies.
     */
    public function getAvailableCurrencies(): array
    {
        return array_keys($this->fallbackRates);
    }

    /**
     * Force refresh all rates from the live API.
     */
    public function refreshRates(): bool
    {
        try {
            $response = Http::timeout(10)->get('https://open.er-api.com/v6/latest/USD');

            if ($response->successful()) {
                $rates = $response->json()['rates'] ?? [];
                foreach ($rates as $currency => $rate) {
                    Cache::put("fx_usd_{$currency}", (float) $rate, 300);
                }
                Log::info('FX rates refreshed successfully.', ['count' => count($rates)]);
                return true;
            }
        } catch (\Exception $e) {
            Log::error("FX rate refresh failed: {$e->getMessage()}");
        }

        return false;
    }
}
