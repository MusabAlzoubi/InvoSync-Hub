<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name','industry','address','phone','email','subdomain','tax_number','uuid','jo_user_id','jo_api_key','is_active'];
    public function users() { return $this->hasMany(User::class); }
    public function customers() { return $this->hasMany(Customer::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
    public function settings() { return $this->hasMany(Setting::class); }
    public function suppliers() { return $this->hasMany(Supplier::class); }
    public function bankAccounts() { return $this->hasMany(BankAccount::class); }
    public function budgets() { return $this->hasMany(Budget::class); }
    public function assets() { return $this->hasMany(Asset::class); }
    public function accounts() { return $this->hasMany(Account::class); }
    public function apiClients() { return $this->hasMany(ApiClients::class); }
    public function attachments() { return $this->hasMany(Attachment::class); }
    public function auditLog() { return $this->hasMany(AuditLog::class); }
}
