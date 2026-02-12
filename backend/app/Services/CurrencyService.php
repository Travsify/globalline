<?php

namespace App\Services;

class CurrencyService
{
    /**
     * Mock exchange rates. In production, these would be fetched from an API or DB.
     * Base is always USD.
     */
    protected array $rates = [
        'USD' => 1.0,
        'NGN' => 1500.0, // Example rate
        'TRY' => 30.0,   // Example rate
    ];

    /**
     * Convert USD to a target currency.
     *
     * @param float $amount
     * @param string $currency
     * @return float
     */
    public function convert(float $amount, string $currency = 'USD'): float
    {
        $rate = $this->rates[strtoupper($currency)] ?? 1.0;
        return $amount * $rate;
    }

    /**
     * Get the currency symbol.
     *
     * @param string $currency
     * @return string
     */
    public function getSymbol(string $currency): string
    {
        return match (strtoupper($currency)) {
            'NGN' => '₦',
            'TRY' => '₺',
            'USD' => '$',
            default => '$',
        };
    }

    /**
     * Get available currencies.
     */
    public function getAvailableCurrencies(): array
    {
        return array_keys($this->rates);
    }
}
