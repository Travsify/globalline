<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SupportTicket;
use App\Models\User;

class SupportMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'support_ticket_id', 'user_id', 'message', 'attachment_url', 'is_admin'
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function ticket()
    {
        return $this->belongsTo(SupportTicket::class, 'support_ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
