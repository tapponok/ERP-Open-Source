<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userhaserole extends Model
{
    protected $table = 'model_has_roles';
    public $timestamps = false;
    public $incrementing = false;
    use HasFactory;

    public function userlist(){
        return $this->belongsTo(User::class, 'model_id');
    }
    public function permissionlist(){
        return $this->belongsTo(Roleuser::class, 'permission_id');
    }
}
