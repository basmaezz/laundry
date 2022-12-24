<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderExtra extends Model
{
    protected $table   = 'provider_extras';
    protected $guarded = [];

    /**  public function product . */
    public function extra()
    {
        return $this->belongsTo(Extra::class,'extra_id');
    }
}
