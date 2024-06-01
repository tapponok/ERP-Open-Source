<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_product extends Model
{
    protected $table = "group_products";
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function product(){
        return $this->hasMany(Product::class, 'group_product_id', 'id');
    }
}
