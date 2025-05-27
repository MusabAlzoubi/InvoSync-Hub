<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'amount',
        'payment_date',
        'method'
    ];

    protected $dates = [
        'payment_date'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
