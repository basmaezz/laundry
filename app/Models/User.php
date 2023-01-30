<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Maize\Markable\Models\Favorite;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'joindate',
        'avatar',
        'subCategory_id'
    ];
    protected $dates = ['joindate'];

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
    protected static $marks = [
        Favorite::class,
    ];

    public function setPasswordAttribute($password){
        return $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }
    public function getImageAttribute()
    {
        return $this->avtar;
    }
    public function setImageAttribute($value)
    {
        $attribute_name = "avatar";
        //Uploads disk for example
        $disk = "uploads";
    }

    public function Roles(){
        return $this->belongsToMany(Role::class,'role_user');
    }
    public function is($roleName)
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->role == $roleName)
            {
                return true;
            }
        }

        return false;
    }

}
