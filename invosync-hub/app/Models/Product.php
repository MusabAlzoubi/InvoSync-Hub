<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'category',
        'stock_quantity'
    ];

    public function supplierReturns()
    {
        return $this->hasMany(SupplierReturn::class);
    }
}
