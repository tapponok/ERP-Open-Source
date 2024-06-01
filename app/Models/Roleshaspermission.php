<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roleshaspermission extends Model
{
    protected $table = 'role_has_permissions';
    public $timestamps = false;
    public $incrementing = false;
    use HasFactory;

    public function roleslist(){
        return $this->belongsTo(Roleuser::class, 'role_id');
    }
    public function permissionlist(){
        return $this->belongsTo(Permissionuser::class, 'permission_id');
    }
}
