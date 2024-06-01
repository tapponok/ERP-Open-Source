<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocklog extends Model
{
    protected $table = 'stock_logs';
    use HasFactory;

    public function productid(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function garageid(){
        return $this->belongsTo(Garage::class, 'garage_id');
    }
    public function createdby(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
