<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    use HasFactory;
    protected $fillable = [
        'name',
        'isarchive',
        'created_by'
    ];
    public function salesorder_id(){
        return $this->hasMany(Sales_order::class, 'payment_id', 'id');
    }
    public function salesinvoice_id(){
        return $this->hasMany(salesInvoiceItems::class, 'id');
    }
}
