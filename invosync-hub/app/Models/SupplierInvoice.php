<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'invoice_date',
        'total_amount'
    ];

    protected $dates = [
        'invoice_date'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
