<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{

    use HasFactory;
    protected $fillable = [
        'company_id',
        'user_id',
        'customer_id',
        'invoice_number',
        'type',
        'original_invoice_id',
        'issue_date',
        'payment_method',
        'subtotal',
        'tax_total',
        'total',
        'currency',
        'status',
        'national_uuid',
        'digital_signature',
        'qr_code_data',
        'notes',
        'sent_at',
        'validated_at'
    ];
    public function company() { return $this->belongsTo(Company::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function customer() { return $this->belongsTo(Customer::class); }
    public function items() { return $this->hasMany(InvoiceItem::class); }
    public function statusLogs() { return $this->hasMany(InvoiceStatusLog::class); }
    public function errors() { return $this->hasMany(IntegrationError::class); }
    public function documents() { return $this->hasMany(InvoiceDocument::class); }

}
