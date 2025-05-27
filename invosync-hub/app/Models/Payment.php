<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'amount',
        'payment_date',
        'method'
    ];

    protected $dates = [
        'payment_date'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
