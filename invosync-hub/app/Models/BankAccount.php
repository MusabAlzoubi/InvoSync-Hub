<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'account_name',
        'bank_name',
        'account_number',
        'balance'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function reconciliations()
    {
        return $this->hasMany(Reconciliation::class);
    }
}
