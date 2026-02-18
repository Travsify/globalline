<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VirtualAddress extends Model
{
    protected $fillable = [
        'user_id',
        'suite_number',
        'region',
        'provider_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
