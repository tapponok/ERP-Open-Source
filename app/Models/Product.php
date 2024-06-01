<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    use \Rackbeat\UIAvatars\HasAvatar;
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'product_code',
        'sku',
        'category_id',
        'product_photo',
        'unit_id',
        'garage_id',
        'expired_date',
        'minimum_stock',
        'stock',
        'selling_price',
        'have_child',
        'created_at',
        'updated_at',
        'updated_by',
        'created_by',
    ];
    public function getAvatarNameKey()
    {
        return 'product_name';
    }
    public function getPhotoOrAvatarAttribute()
    {
        if ($this->product_photo != null) {
            return asset('storage/product/' . $this->product_photo);
        } else {
            // Jika product_photo null, kembalikan URL avatar default di sini
            return $this->getUrlfriendlyAvatar();
        }
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function garage()
    {
        return $this->belongsTo(Garage::class, 'garage_id');
    }
    public function groupproduct()
    {
        return $this->belongsTo(Group_product::class, 'group_product_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function purchaseorderitem()
    {
        return $this->hasMany(Purchase_order_item::class);
    }
    public function purchaseinvoiceitem()
    {
        return $this->hasMany(Purchase_invoice_item::class);
    }
    public function productgaragestock()
    {
        return $this->hasMany(Product_garage_stock::class);
    }
    public function receiveorderitem()
    {
        return $this->hasMany(Receive_order_item::class);
    }
    public function stocklog()
    {
        return $this->hasMany(Stocklog::class);
    }
    public function stokopnameitem()
    {
        return $this->hasMany(Stock_opname_item::class);
    }
}
