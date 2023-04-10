<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    protected $table   = 'cities';
    protected $guarded = [];
    use SoftDeletes;

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
