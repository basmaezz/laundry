<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
//    public function setCreatedAtAttribute( $value ) {
//        $this->attributes['created_at'] = (new Carbon($value))->format('Y-m-d');
//    }

    public function order(){
        return $this->belongsTo(OrderTable::class,'order_id','id')->withDefault();
    }

    public function appUser(){
        return $this->belongsTo(User::class,'app_user_id','id')->withDefault();
    }
}
