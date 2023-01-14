<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable= ['role','abilities'];
    protected $casts=['abilities'=>'array'];

    public function Permissions()
    {
        return $this->hasMany('App\Models\Permission','role_id','id');
    }
    public function Users(){
        return $this->belongsToMany(User::class ,'role_user');
    }
}
