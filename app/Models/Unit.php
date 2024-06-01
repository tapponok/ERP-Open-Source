<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'units';
    
    public function createdby(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function updatedby(){
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function product(){
        return $this->hasMany(Product::class);
    }
    public function productchild(){
        return $this->hasMany(Product_child::class);
    }

}
