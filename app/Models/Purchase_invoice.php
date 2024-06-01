<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_invoice extends Model
{
    protected $table = 'puchase_invoices';
    use HasFactory;

    protected $fillable = [
        'pi_number',
        'status',
        'total',
        'note',
        'purchase_order_id',
        'supplier_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'approved_at',
        'approved_by',
        'canceled_at',
        'canceled_by',
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
    public function puchaseorderid(){
        return $this->belongsTo(Purchase_order::class, 'purchase_order_id');
    }
    public function supplierid(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function garageid(){
        return $this->belongsTo(Garage::class, 'garage_id');
    }
    public function purchaseinvoiceitem(){
        return $this->hasMany(Purchase_invoice_item::class);
    }
    public function receiveorder(){
        return $this->hasMany(Receive_order::class);
    }
}
