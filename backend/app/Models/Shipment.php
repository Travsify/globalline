<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
    protected $fillable = [
        'user_id', 'tracking_number', 'origin', 'origin_country',
        'destination', 'destination_country', 'status', 'weight',
        'weight_unit', 'price', 'currency', 'receiver_name',
        'receiver_phone', 'receiver_email', 'description',
        'metadata', 'estimated_delivery', 'delivered_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'estimated_delivery' => 'datetime',
        'delivered_at' => 'datetime',
        'price' => 'decimal:2',
        'weight' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function generateTrackingNumber(): string
    {
        return 'GL' . strtoupper(substr(uniqid(), -8)) . rand(10, 99);
    }
}
