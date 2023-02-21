<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        "description",
        "app_user_id",
        "city_id",
        "region_name",
        "address",
        "building",
        'lat',
        'lng',
        'image',
        "default"
    ];

    protected $casts = [
        'default'=>'boolean'
        ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(){
        return isset($this->attributes['image'])? asset('assets/uploads/users_image/'.$this->attributes['image']) : null;
    }

    public function city(){
        return $this->hasOne(City::class, 'id', 'id')->withDefault();
    }

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
