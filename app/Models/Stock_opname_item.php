<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_opname_item extends Model
{
    protected $table = 'stockopname_items';
    use HasFactory;

    public function garageid(){
        return $this->belongsTo(Garage::class, 'garage_id');
    }
    public function productid(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function stokopnameid(){
        return $this->belongsTo(Product::class, 'stockopname_id');
    }

}
