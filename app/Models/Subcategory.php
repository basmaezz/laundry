<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\SubCategoryStatus;
use App\Traits\SelfReferenceTrait;
use Illuminate\Database\Eloquent\Model;
use Maize\Markable\Markable;
use Maize\Markable\Models\Favorite;

class Subcategory extends Model
{
    use Markable;
    use SoftDeletes;

    protected  $table   = 'subcategories';
    protected  $guarded = [];
    protected $fillable=['category_id','name_en','name_ar','parent_id','address','city_id','location','range','price','status','around_clock','clock_at','clock_end','image','rate','approximate_duration','lat','lng'];
//    protected $casts = ['status' => SubCategoryStatus::class  ];
    protected $attributes=[
        'status'=>'1',
        'rate'=>'5'
];
    protected static $marks = [
        Favorite::class,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
    public function getImageAttribute($image)
    {
        return  isset($image) ? assetsUpload().'/laundries/logo/'. $image : '';
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

    public function childrenTrashed(){
        return $this->hasMany(Subcategory::class,'parent_id')->withTrashed();
    }

    public function parentTrashed(){
        return $this->belongsTo(Subcategory::class,'parent_id')->withTrashed();
    }
    public function user(){
        return $this->hasMany(User::class,'subCategory_id');
    }
}
