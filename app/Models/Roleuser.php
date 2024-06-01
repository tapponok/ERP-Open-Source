<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roleuser extends Model
{
    protected $table = 'roles';
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function modelhasroles(){
        return $this->hasMany(Userhaserole::class);
    }
    public function roleslist(){
        return $this->hasMany(Roleshaspermission::class);
    }
}
