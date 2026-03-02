<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformAccount extends Model
{
    protected $fillable = ['currency', 'balance', 'description'];

    protected $casts = [
        'balance' => 'decimal:4',
    ];

    /**
     * Get the platform pool for a specific currency.
     */
    public static function forCurrency(string $currency): self
    {
        return static::firstOrCreate(
            ['currency' => strtoupper($currency)],
            ['balance' => 0, 'description' => "GlobalLine {$currency} Pool"]
        );
    }
}
