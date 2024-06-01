<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_number',
        'status',
        'total',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'approved_at',
        'approved_by',
        'canceled_at',
        'canceled_by',
        'supplier_id',
        'garage_id',
        'note',
    ];
    public function createdby(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedby(){
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function approvedby(){
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function canceledby(){
        return $this->belongsTo(User::class, 'canceled_by');
    }
    public function supplierid(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function purchaseorderitem(){
        return $this->hasMany(Purchase_order_item::class);
    }
    public function purchaseinvoice(){
        return $this->belongsTo(Purchase_invoice::class);
    }
    public function garageid(){
        return $this->belongsTo(Garage::class, 'garage_id');
    }
    public function receiveorder(){
        return $this->hasMany(Receive_order::class);
    }
}
