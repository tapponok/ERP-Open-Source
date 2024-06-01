<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesInvoiceItems extends Model
{
    protected $table = 'sales_invoice_items';
    use HasFactory;

    public $timestamps = false;

    public function salesInvoice(){
        return $this->belongsTo(salesInvoice::class);
    }
    public function paymentid(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }
    public function salesorderid(){
        return $this->belongsTo(Sales_order::class, 'sales_order_id');
    }
    public function partnershipid(){
        return $this->belongsTo(Partnership::class, 'partnership_id');
    }
    public function sales(){
        return $this->belongsTo(User::class, 'sales');
    }
    public function submitedby(){
        return $this->belongsTo(User::class, 'submited_by');
    }
    public function approvedby(){
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function cancelledby(){
        return $this->belongsTo(User::class, 'cancelled_by');
    }
    public function garageid(){
        return $this->belongsTo(Garage::class, 'garage_id');
    }

}
