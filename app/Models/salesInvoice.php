<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesInvoice extends Model
{
    protected $table = 'sales_invoices';
    use HasFactory;
    public function salesInvoiceItem(){
        return $this->hasMany(salesInvoiceItems::class, 'sales_invoice_id', 'id');
    }
    public function salesorderid(){
        return $this->belongsTo(Sales_order::class, 'sales_order_id');
    }
}
