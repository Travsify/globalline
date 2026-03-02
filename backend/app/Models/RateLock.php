<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class RateLock extends Model
{
    protected $primaryKey = 'lock_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'lock_id', 'from_currency', 'to_currency', 'rate',
        'markup_pct', 'expires_at', 'used', 'user_id',
    ];

    protected $casts = [
        'rate' => 'decimal:8',
        'markup_pct' => 'decimal:4',
        'expires_at' => 'datetime',
        'used' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->lock_id)) {
                $model->lock_id = (string) Str::uuid();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if this lock is still valid (not expired, not used).
     */
    public function isValid(): bool
    {
        return !$this->used && $this->expires_at->isFuture();
    }

    /**
     * Mark this lock as consumed.
     */
    public function consume(): void
    {
        $this->update(['used' => true]);
    }

    /**
     * Scope: active (unexpired, unused) locks.
     */
    public function scopeActive($query)
    {
        return $query->where('used', false)->where('expires_at', '>', now());
    }
}
