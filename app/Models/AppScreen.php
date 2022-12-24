<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppScreen extends Model
{
    protected $table   = 'app_screens';
    protected $guarded = [];

    public function getImageAttribute($image)
    {
        return  isset($image) ? assetsUpload().'/app_screens/'. $image : '';
    }

}
