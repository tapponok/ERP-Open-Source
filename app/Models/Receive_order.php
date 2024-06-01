<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receive_order extends Model
{
    protected $table = 'receive_orders';
    use HasFactory;

    protected $fillable = [
        'codereceived',
        'purchaseorder_id',
        'puchaseinvoice_id',
        'garage_id',
        'supplier_id',
        'received_by',
        'updated_by',
        'approved_by',
        'cancelled_by',
        'receivedate',
        'lisenseplate',
        'status',
        'created_at',
        'updated_at',
    ];
    public function purchaseorderid(){
        return $this->belongsTo(Purchase_order::class, 'purchaseorder_id');
    }
    public function puchaseinvoiceid(){
        return $this->belongsTo(Purchase_invoice::class, 'purchaseinvoice_id');
    }
    public function garageid(){
        return $this->belongsTo(Garage::class, 'garage_id');
    }
    public function supplierid(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function receivedby(){
        return $this->belongsTo(User::class, 'received_by');
    }
    public function updatedby(){
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function approvedby(){
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function cancelledby(){
        return $this->belongsTo(User::class, 'cancelled_by');
    }
    public function receiveoderitem(){
        return $this->hasMany(Receive_order_item::class);
    }
}
