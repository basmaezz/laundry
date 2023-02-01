<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table   = 'notifications';
    protected $guarded = [];
    protected $fillable = [
        'order_id',
        'seen',
        'content_en',
        'content_ar',
        'type',
        'app_user_id',
        'title_ar',
        'title_en',
        'send'
    ];

    public function order(){
        return $this->belongsTo(OrderTable::class,'order_id','id')->withDefault();
    }

    public function appUser(){
        return $this->belongsTo(AppUser::class,'app_user_id','id')->withDefault();
    }
}
