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
        'user_id',
        'title_ar',
        'title_en',
        'send'
    ];

    public function order(){
        return $this->belongsTo(OrderTable::class,'order_id','id')->withDefault();
    }
}
