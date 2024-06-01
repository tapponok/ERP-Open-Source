<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissionuser extends Model
{
    protected $table = 'permissions';
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    // public function permissiondata()
    // {
    //     return $this->belongsToMany(
    //         Permissionuser::class,
    //         'model_has_permissions', 'permission_id', 'model_id');
    // }
    public function roleshaspermission(){
        return $this->belongsToMany(roleshaspermission::class);
    }
}
