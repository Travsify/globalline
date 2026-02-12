<?php

namespace App\Services;

class PricingService
{
    /**
     * The admin-configured markup percentage (e.g., 0.15 for 15%).
     * This could eventually be moved to a settings table.
     */
    protected float $markupPercentage = 0.15;

    /**
     * Apply the markup to a base USD price.
     *
     * @param float $basePrice
     * @return float
     */
    public function applyMarkup(float $basePrice): float
    {
        return $basePrice * (1 + $this->markupPercentage);
    }

    /**
     * Format the price for the UI.
     *
     * @param float $price
     * @return string
     */
    public function formatPrice(float $price): string
    {
        return number_format($price, 2);
    }
}
