<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebhookLog extends Model
{
    protected $fillable = [
        'event',
        'url',
        'payload',
        'response_code',
        'response_body',
        'status',
        'retries',
        'last_retry_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'last_retry_at' => 'datetime',
    ];
}
