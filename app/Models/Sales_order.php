<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_order extends Model
{
    protected $table = 'salesorders';
    use HasFactory;

    protected $fillable = [
        'salesorder_code',
        'estimate_date',
        'partnership_id',
        'payment_id',
        'garage_id',
        'address',
        'city',
        'province',
        'postal_code',
        'total',
        'discount',
        'total_discount',
        'tax_percent',
        'tax_total',
        'shipment_cost',
        'total_charge',
        'created_by',
        'date_order',
        'approved_by',
        'canceled_by',
        'notes',
    ];

    public function calculatetotalcharge(){
        $this->total_charge = $this->total - $this->total_discount - $this->tax_total;
        $this->save();
        return $this;
    }

    public function paymentid(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }
    public function partnershipid(){
        return $this->belongsTo(Partnership::class, 'partnership_id');
    }
    public function sales(){
        return $this->belongsTo(User::class, 'sales');
    }
    public function craetedby(){
        return $this->belongsTo(User::class, 'craeted_by');
    }
    public function approvedby(){
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function cancelledby(){
        return $this->belongsTo(User::class, 'cancelled_by');
    }
    public function salesorderid(){
        return $this->hasMany(Salesorder_item::class, 'salesorder_id', 'id');
    }
    public function salesinvoiceid(){
        return $this->hasMany(salesInvoiceItems::class,'id');
    }
    public function invoice(){
        return $this->belongsTo(salesInvoice::class,'id');
    }
    public function garageid(){
        return $this->belongsTo(Garage::class, 'garage_id');
    }
}
