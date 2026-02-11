<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KycVerification extends Model
{
    protected $fillable = ['user_id', 'id_type', 'id_number', 'document_url', 'status', 'reason', 'provider_reference'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
