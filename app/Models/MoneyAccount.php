<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoneyAccount extends Model
{
    protected $table   = 'money_accounts';
    protected $guarded = [];


    public function User()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }

    public function package()
    {
      return $this->belongsTo(Package::class ,'package_id');
    }
}
