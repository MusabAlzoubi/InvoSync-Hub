<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'key',
        'value'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
