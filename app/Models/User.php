<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use \Rackbeat\UIAvatars\HasAvatar;
    use HasFactory, Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function category(){
        return $this->hasMany(Category::class, 'id');
    }

    public function unit(){
        return $this->hasMany(Unit::class,'id');
    }

    public function garageid(){
        return $this->belongsTo(Garage::class, 'garage_id', 'id');
    }

    public function product(){
        return $this->hasMany(Product::class, 'id');
    }

    public function productchild(){
        return $this->hasMany(Product_child::class, 'id');
    }

    public function purchaseorder(){
        return $this->hasMany(Purchase_order::class, 'id');
    }

    public function receiveorder(){
        return $this->hasMany(Receive_order::class);
    }

    public function stocklog(){
        return $this->hasMany(Stocklog::class);
    }

    public function stockopname(){
        return $this->hasMany(Stock_opname::class, 'id');
    }
    public function salesInvoice(){
        return $this->hasMany(salesInvoiceItems::class, 'id');
    }

    public function modelhasrole(){
        return $this->hasMany(Userhaserole::class, 'model_id', 'id');
    }
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
