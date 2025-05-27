<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebhookLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'target_url',
        'payload',
        'response',
        'status_code',
        'success'
    ];

    protected $casts = [
        'payload' => 'array',
        'response' => 'array',
        'success' => 'boolean'
    ];
}
