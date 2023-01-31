<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table   = 'cities';
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regions()
    {
        return $this->hasMany(Region::class,'city_id','id');
    }

    public function name() : Attribute
    {
        return Attribute::make(
            get: function() {
                $name='name_'.app()->getLocale();
                return $this->$name;
            },
        );
    }
}
