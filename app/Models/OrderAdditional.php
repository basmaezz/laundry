<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAdditional extends Model
{
    protected  $table   = 'order_additionals';
    protected  $guarded = [];

    public function extra()
    {
        return $this->belongsTo(Extra::class,'extra_id');
    }

    public function providerExtra()
    {
        return $this->belongsTo(ProviderExtra::class,'extra_id');
    }
}
