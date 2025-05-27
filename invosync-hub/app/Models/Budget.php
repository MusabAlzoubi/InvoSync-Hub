<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'year',
        'total_income',
        'total_expense'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
