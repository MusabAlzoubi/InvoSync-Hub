<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceItemTax extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_item_id',
        'tax_type',
        'tax_rate',
        'tax_amount'
    ];

    public function invoiceItem()
    {
        return $this->belongsTo(InvoiceItem::class);
    }
}
