<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesorder_item extends Model
{
    protected $table = 'salesorder_items';
    use HasFactory;

    protected $fillable = [
        'salesorder_id',
        'product_id',
        'product_code',
        'product_name',
        'quantity',
        'price',
        'discount_percentage',
        'discounttotal',
        'subtotal',
        'total_after_discount',
        'isarchive',
    ];
    public function salesorderid(){
        return $this->belongsTo(Sales_order::class, 'salesorder_id');
    }
    public function productid(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
