<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    protected $table = 'partnerships';
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'province',
        'bankname',
        'bankaccount',
        'isarchive',
        'created_by',
    ];
    public function salesorder(){
        return $this->hasMany(Sales_order::class, 'partnership_id', 'id');
    }
    public function salesInvoice(){
        return $this->hasMany(salesInvoiceItems::class, 'partnership_id', 'id');
    }
}
