<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApiClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'client_name',
        'api_key',
        'ip_whitelist',
        'is_active'
    ];

    protected $casts = [
        'ip_whitelist' => 'array',
        'is_active' => 'boolean'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
