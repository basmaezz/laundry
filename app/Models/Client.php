<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table   = 'clients';
    protected $guarded = [];

    public function getImageAttribute($image)
    {
        return  isset($image) ? assetsUpload().'/clients/'. $image : '';
    }

}
