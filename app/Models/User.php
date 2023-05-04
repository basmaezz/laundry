<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'password',
        'level_id',
        'birthdate',
        'joinDate',
        'avatar',
        'subCategory_id',
        'role_id'
    ];
    protected $dates = ['joinDate'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password){
        return $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }

//    public function getImageAttribute($image)
//    {
//        return  isset($image) ? 'assets/uploads/images/'. $image : '';
//    }
//    public function getImageAttribute()
//    {
//        return $this->avtar;
//    }
//    public function setImageAttribute($value)
//    {
//        $attribute_name = "avatar";
//        //Uploads disk for example
//        $disk = "uploads";
//    }

    public function Roles(){
        return $this->belongsToMany(Role::class,'role_user');
    }

    public function hasAbility($ability)
    {
        foreach ($this->roles as $role){
            if(in_array($ability,$role->abilities)){
                return  true;
            }
        }
        return false;

    }

    public function Levels(){
        return $this->belongsTo(educationLevel::class, 	'level_id');
    }

    public function  hasRole($user)
    {
        if($user->roles->count()>0){
            return $user->Roles->first()->id;
        }else{
            return $user->Roles->id=1;
        }
    }
    public function  hasRoleName($user)
    {
        if($user->roles->count()>0){
            return $user->Roles->first()->role;
        }else{
            return '';
        }
    }




}
