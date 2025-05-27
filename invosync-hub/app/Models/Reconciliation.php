<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reconciliation extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_account_id',
        'amount',
        'date'
    ];

    protected $dates = [
        'date'
    ];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }
}
