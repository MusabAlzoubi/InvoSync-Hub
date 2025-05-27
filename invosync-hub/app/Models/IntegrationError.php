<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IntegrationError extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'code',
        'message',
        'response',
        'resolved'
    ];

    protected $casts = [
        'resolved' => 'boolean'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
