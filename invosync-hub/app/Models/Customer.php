<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['company_id','name','type','phone','email','address','tax_number','national_id'];
    public function company() { return $this->belongsTo(Company::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
    public function payments() { return $this->hasMany(Payment::class); }
    public function notifications() { return $this->hasMany(Notification::class); }
}
