<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeConfiguration extends Model
{
    protected $fillable = [
        'corridor', 'transfer_fee_flat', 'transfer_fee_pct',
        'fx_markup_pct', 'min_amount', 'max_amount', 'is_active',
    ];

    protected $casts = [
        'transfer_fee_flat' => 'decimal:2',
        'transfer_fee_pct' => 'decimal:4',
        'fx_markup_pct' => 'decimal:4',
        'min_amount' => 'decimal:2',
        'max_amount' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the fee config for a given currency pair.
     * Falls back to SAME_CURRENCY if from === to.
     */
    public static function forCorridor(string $from, string $to): ?self
    {
        if (strtoupper($from) === strtoupper($to)) {
            return static::where('corridor', 'SAME_CURRENCY')->where('is_active', true)->first();
        }

        $corridor = strtoupper($from) . '_' . strtoupper($to);
        $config = static::where('corridor', $corridor)->where('is_active', true)->first();

        // Try reverse corridor (symmetric)
        if (!$config) {
            $reverse = strtoupper($to) . '_' . strtoupper($from);
            $config = static::where('corridor', $reverse)->where('is_active', true)->first();
        }

        return $config;
    }
}
