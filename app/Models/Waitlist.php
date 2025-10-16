<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waitlist extends Model
{
    protected $table = 'waitlist';
    protected $fillable = [
        'email',
        'name',
        'company',
        'message',
        'email_sent',
        'email_sent_at',
    ];

    protected $casts = [
        'email_sent' => 'boolean',
        'email_sent_at' => 'datetime',
    ];
}
