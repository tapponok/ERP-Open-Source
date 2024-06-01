<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Purchase_order_item extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_order_id',
        'product_id',
        'price',
        'quantity',
        'subtotal',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
    public function purchaseorder(){
        return $this->belongsTo(Purchase_order::class, 'purchase_order_id');
    }
    public function productid(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
