<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LedgerEntry extends Model
{
    protected $fillable = [
        'transaction_group_id', 'account_id', 'account_type',
        'entry_type', 'amount', 'currency', 'balance_after',
        'description', 'reference', 'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'amount' => 'decimal:4',
        'balance_after' => 'decimal:4',
    ];

    /**
     * Get the owning account (User or PlatformAccount).
     */
    public function account()
    {
        if ($this->account_type === 'platform') {
            return $this->belongsTo(PlatformAccount::class, 'account_id');
        }
        return $this->belongsTo(User::class, 'account_id');
    }

    /**
     * Scope: entries for a specific user account.
     */
    public function scopeForUser($query, int $userId, ?string $currency = null)
    {
        $query->where('account_id', $userId)->where('account_type', 'user');
        if ($currency) {
            $query->where('currency', $currency);
        }
        return $query;
    }

    /**
     * Scope: entries in a specific transaction group.
     */
    public function scopeForGroup($query, string $groupId)
    {
        return $query->where('transaction_group_id', $groupId);
    }
}
