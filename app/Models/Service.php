<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected  $table   = 'services';
    protected  $guarded = [];

    public function category()
    {
       return $this->belongsTo(Category::class,'category_id');
    }
}
