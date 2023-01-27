<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $table   = 'orders';
    protected  $casts   = ['delegates' => 'array'];
    protected  $guarded = [];

    public function delegate()
    {
       return $this->belongsTo(User::class,'delegate_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class,'provider_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function branche()
    {
        return $this->belongsTo(Branche::class,'branche_id');
    }
}
