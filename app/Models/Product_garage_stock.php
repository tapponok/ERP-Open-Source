<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_garage_stock extends Model
{
    protected $table = 'product_garage_stocks';
    use HasFactory;
    protected $fillable = [
        'product_id',
        'garage_id',
        'stock',
    ];
    public function productid(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function garageid(){
        return $this->belongsTo(Garage::class, 'garage_id');
    }
}
