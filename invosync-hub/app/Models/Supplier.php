<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'phone',
        'email',
        'address'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function supplierInvoices()
    {
        return $this->hasMany(SupplierInvoice::class);
    }

    public function supplierReturns()
    {
        return $this->hasMany(SupplierReturn::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function supplierPayments()
    {
        return $this->hasMany(SupplierPayment::class);
    }
}
