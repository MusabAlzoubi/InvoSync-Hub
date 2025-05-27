<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'rate',
        'type',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
