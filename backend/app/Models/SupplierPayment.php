<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplierPayment extends Model
{
    protected $fillable = [
        'user_id', 'supplier_name', 'bank_name', 'account_number',
        'swift_code', 'amount', 'currency', 'local_amount',
        'local_currency', 'status', 'invoice_url', 'proof_url', 'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'local_amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
