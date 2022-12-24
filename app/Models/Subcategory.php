<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Maize\Markable\Markable;
use Maize\Markable\Models\Favorite;

class Subcategory extends Model
{
//    use Markable;
    protected  $table   = 'subcategories';
    protected  $guarded = [];
    protected static $marks = [
        Favorite::class,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function getImageAttribute($image)
    {
        return  isset($image) ? assetsUpload().'/subCategories/'. $image : '';
    }
    public function getIsFavorite()
    {
        return $this->is_favorite == 1 ? true : false;
    }
    public function getRateAvgAttribute()
    {
        $rating = RateLaundry::where('laundry_id',$this->attributes['id']);
        return $rating->count()? number_format($rating->sum('rate') / $rating->count(),2) : 0;
    }

    public function rates(){
        return $this->hasMany(RateLaundry::class,'laundry_id','id');
    }

}
