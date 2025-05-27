<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'amount',
        'description',
        'date'
    ];

    protected $dates = [
        'date'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
