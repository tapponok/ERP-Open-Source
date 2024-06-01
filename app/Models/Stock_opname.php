<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_opname extends Model
{
    protected $table = 'stockopnames';
    use HasFactory;

    public function stokopnameitem(){
        return $this->hasMany(Stock_opname_item::class, 'stockopname_id');
    }
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
}
