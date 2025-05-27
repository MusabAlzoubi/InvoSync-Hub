<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'attachable_id',
        'attachable_type',
        'file_name',
        'file_path',
        'file_type'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function attachable()
    {
        return $this->morphTo();
    }
}
