<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'categ_name',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function createdby(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function updatedby(){
        return $this->belongsTo(User::class,'updated_by');
    }
    
    public function product(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
