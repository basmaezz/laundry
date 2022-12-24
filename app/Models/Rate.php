<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table   = 'ratings';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class ,'order_id');
    }
}
