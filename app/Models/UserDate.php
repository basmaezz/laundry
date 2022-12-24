<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDate extends Model
{
    protected $table   = "user_dates";
    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo('App\User','user_id');
    }
}
