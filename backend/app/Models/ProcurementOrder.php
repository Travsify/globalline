<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProcurementOrder extends Model
{
    protected $fillable = [
        'user_id', 'product_url', 'product_name', 'quantity',
        'specifications', 'unit_price', 'total_price', 'currency',
        'status', 'instructions', 'admin_notes',
    ];

    protected $casts = [
        'specifications' => 'array',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
