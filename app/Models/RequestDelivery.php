<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestDelivery extends Model
{
    protected $guarded = [];
    protected $table   = 'requests_delivery';

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
