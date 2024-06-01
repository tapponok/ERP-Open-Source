<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receive_order_item extends Model
{
    protected $table = 'receive_order_items';
    use HasFactory;

    protected $fillable = [
        'receive_order_id',
        'product_id',
        'quantity',
    ];

    public function receiveorderid(){
        return $this->belongsTo(Receive_order::class, 'receive_order_id');
    }
    public function productid(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
