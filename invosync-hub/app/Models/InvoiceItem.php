<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'description',
        'quantity',
        'unit_price',
        'discount',
        'tax_rate',
        'tax_amount',
        'line_total'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function taxes()
    {
        return $this->hasMany(InvoiceItemTax::class);
    }
}
