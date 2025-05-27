<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClosingDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_start',
        'period_end'
    ];
}
