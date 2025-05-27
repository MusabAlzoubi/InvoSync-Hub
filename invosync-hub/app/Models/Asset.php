<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'value',
        'purchase_date'
    ];

    protected $dates = [
        'purchase_date'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
