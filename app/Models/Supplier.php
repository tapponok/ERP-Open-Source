<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    use HasFactory;
    use \Rackbeat\UIAvatars\HasAvatar;

    protected $fillable = [
        'supplier_name',
        'email',
        'phone',
        'city',
        'province',
        'postalcode',
        'photo_path',
        'shop_name',
        'account_number',
        'bank_name'
    ];
    public function getAvatarNameKey(){
        return 'supplier_name';
    }
    public function purchaseorder(){
        return $this->hasMany(Purchase_order::class, 'id');
    }
    public function receiveorder(){
        return $this->hasMany(Receive_order::class);
    }
}
