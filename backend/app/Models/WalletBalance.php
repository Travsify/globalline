<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletBalance extends Model
{
    protected $fillable = ['user_id', 'currency', 'amount'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
