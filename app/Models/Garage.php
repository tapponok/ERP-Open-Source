<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Garage extends Model
{
    protected $table = 'garages';
    use HasFactory;
    use HasRoles;

    protected $fillable = [
        'garagename',
        'address',
        'city',
        'province',
        'postalcode',
        'created_by',
        'updated_by',
    ];
    public function productchild(){
        return $this->hasMany(Product_child::class, 'id');
    }
    public function userid(){
        return $this->hasMany(User::class);
    }
    public function updatedby(){
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function purchaseorder(){
        return $this->hasMany(Purchase_order::class);
    }
    public function purchaseinvoice(){
        return $this->hasMany(Purchase_invoice::class);
    }
    public function productgaragestock(){
        return $this->hasMany(Product_garage_stock::class);
    }
    public function salesInvoice(){
        return $this->hasMany(salesInvoiceItems::class);
    }
    public function receiveorder(){
        return $this->hasMany(Receive_order::class);
    }
    public function stocklog(){
        return $this->hasMany(Stocklog::class);
    }
    public function productid(){
        return $this->hasMany(Product::class);
    }
    public function stokopnameitem(){
        return $this->hasMany(Stock_opname_item::class);
    }
}
