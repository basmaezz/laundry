<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponShopCart extends Model
{
    protected $table   = 'coupon_shop_carts';
    protected $casts   = ['date_from','date_to'];
    protected $guarded = [];
    protected  $fillable=['code_name','discount_value','date_from','date_to','status'];

    /**  public function user . */
    public function user()
    {
        return $this->belongsTo(AppUser::class,'user_id');
    }


}
