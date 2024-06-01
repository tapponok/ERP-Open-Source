<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_invoice_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_invoice_id',
        'product_id',
        'price',
        'quantity',
        'subtotal',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
    public function purchasinvoice(){
        return $this->belongsTo(Purchase_invoice::class, 'purchase_invoice_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
