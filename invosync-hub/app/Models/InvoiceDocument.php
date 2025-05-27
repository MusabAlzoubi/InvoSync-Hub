<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'ubl_xml',
        'response_payload'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
