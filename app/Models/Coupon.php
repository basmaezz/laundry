<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table   = 'coupons';
    protected $casts   = ['date_from','date_to'];
    protected $guarded = [];

    /**  public function user . */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
