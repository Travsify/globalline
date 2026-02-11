<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SourcingRequest extends Model
{
    protected $fillable = ['user_id', 'product_name', 'description', 'reference_image_url', 'status', 'target_price'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
