<?php

namespace App\Http\Controllers\API;

use App\Models\AppUser;
use App\Models\carpetLaundry;
use App\Models\carpetLaundryTime;
use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\CouponShopCart;
use App\Models\OrderDetails;
use App\Models\OrderTable;
use App\Models\ProductService;
use App\Models\RateLaundry;
use App\Models\Subcategory;
use App\Models\carpetCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Maize\Markable\Models\Favorite;

class CategoryController extends Controller
{
    public function getShowSubCategories($type)
    {
        if ($type == 1) {
            $subCategories = Subcategory::where('category_id', '1')->get();
        } elseif ($type == 4) {
            $subCategories = Subcategory::where('urgentWash', '1')->get();
        }elseif ($type == 3){
            $subCategories = Subcategory::where('category_id','3')->get();
        }
        elseif($type!=1 || $type !=4 ||$type !=3){
            $subCategories='';
        }
        $name = 'name_' . App::getLocale();
        $data = [];

        $user = auth('app_users_api')->user();
        //$user = AppUser::where('id',27)->first();
        $lng = \request('lng') ?? $user->lng ?? '';
        $lat = \request('lat') ?? $user->lat ?? '';
        if($subCategories !=null)
            if($type==1){
                foreach ($subCategories as $subcategory) {
                    $distance = distance($lat, $lng, $subcategory->lat, $subcategory->lng);
                    $range = $subcategory->range;
                    $distanceClass = getDistanceClass($distance, $range);
                    if($distanceClass == "OUT_AREA"){
                        continue;
                    }
                    $data[] = [
                        'id' => $subcategory->id,
                        'name' => $subcategory->$name,
                        'address' => $subcategory->address,
                        'delivery_fees' => $subcategory->price,
                        'urgent' => $subcategory->urgentWash,
                        'rate' => $subcategory->rate_avg,
                        'is_favorite' => (!empty($user)) ? Favorite::has($subcategory, $user) : false,
                        'image' => $subcategory->image,
                        'location' => $subcategory->location,
                        'lat' => $subcategory->lat,
                        'lng' => $subcategory->lng,
                        'approximate_duration' => $subcategory->approximate_duration,
                        'around_clock'=>$subcategory->around_clock,
                        'vip'=>$subcategory->vip,
                        'distance' => round($distance, 2),
                        'range' => $subcategory->range,
                        'distance_class' =>  $distanceClass,
                        'distance_class_id' =>  getDistanceClassId($distance, $range),
                        'open' =>$subcategory->getIsOpenAttribute() ?'opened':'closed',
                        'review' => $subcategory->rates,
                    ];
                }
            }elseif ($type==3){
                $data = $categoryFormatted = [];
                if($subCategories->count() !=0){
                    foreach ($subCategories as $subcategory) {
                        $distance = distance($lat, $lng, $subcategory->lat, $subcategory->lng);
                        $range = $subcategory->range;
                        $distanceClass = getDistanceClass($distance, $range);
                        if ($distanceClass == "OUT_AREA") {
                            continue;
                        }
                        $data[] = [
                            'id' => $subcategory->id,
                            'name' => $subcategory->$name,
                            'delivery_fees' => $subcategory->price,
                            'location' => $subcategory->location,
                            'lat' => $subcategory->lat,
                            'lng' => $subcategory->lng,
                            'approximate_duration' => $subcategory->approximate_duration,
                            'distance' => round($distance, 2),
                            'range' => $subcategory->range,
                            'distance_class' => $distanceClass,
                            'distance_class_id' => getDistanceClassId($distance, $range),
                        ];

                    }
                    $data = collect($data)->sortBy("distance");
                    $subcategory = $data->first();
                    if(!empty($subcategory)) {
                        $categories = carpetCategory::where('subCategory_id', $subcategory->id)->get();
                        if ($categories->count() > 0) {
                            foreach ($categories as $category) {
                                $name = 'category_' . App::getLocale();
                                $description = 'desc_' . App::getLocale();
                                $categoryFormatted[] = [
                                    'id' => $category->id,
                                    'categoryName' => $category->$name,
                                    'description' => $category->$description,
                                    'price' => $category->price,
                                ];
                            }
                        }
                    }
                    return apiResponse("api.success", $data->toArray(),$categoryFormatted);
                }



            }elseif ($type==4){
                foreach ($subCategories as $subcategory) {
                    $distance = distance($lat, $lng, $subcategory->lat, $subcategory->lng);
                    $range = $subcategory->range;
                    $distanceClass = getDistanceClass($distance, $range);
                    if($distanceClass == "OUT_AREA"){
                        continue;
                    }
                    $data[] = [
                        'id' => $subcategory->id,
                        'name' => $subcategory->$name,
                        'address' => $subcategory->address,
                        'delivery_fees' => $subcategory->price,
                        'urgent' => $subcategory->urgentWash,
                        'rate' => $subcategory->rate_avg,
                        'image' => $subcategory->image,
                        'location' => $subcategory->location,
                        'lat' => $subcategory->lat,
                        'lng' => $subcategory->lng,
                        'approximate_duration' => $subcategory->approximate_duration_urgent,
                        'around_clock'=>$subcategory->around_clock,
                        'vip'=>$subcategory->vip,
                        'distance' => round($distance, 2),
                        'range' => $subcategory->range,
                        'distance_class' =>  $distanceClass,
                        'distance_class_id' =>  getDistanceClassId($distance, $range),
                        'open' =>$subcategory->getIsOpenAttribute() ?'opened':'closed',
                        'review' => $subcategory->rates,
                    ];
                }
            }

        return apiResponse("api.success", $data);


    }

    public function rate(Request $request)
    {

        $user = auth('app_users_api')->user();
        $validator = Validator::make($request->all(), [
            'rate' => 'required|between:0,5',
            'laundry_id' => 'required',
            'order_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        $order = OrderTable::where([
            'user_id' => $user->id,
            'id' => $request->get('order_id'),
        ]);
        if ($order->count() == 0) {
            return response()->json(['The order not related to you'], 422);
        }

        $order = $order->first();
        if ($order->status_id != OrderController::Completed) {
            return response()->json(['The order show be finished'], 422);
        }

        $exist = RateLaundry::where([
            'laundry_id' => $request->get('laundry_id'),
            'order_id' => $request->get('order_id'),
            'user_id' => $user->id,
        ])->count();

        if ($exist != 0) {
            return response()->json(['You already Rate this laundry'], 422);
        }
        $data = RateLaundry::create([
            'user_id' => $user->id,
            'laundry_id' => $request->get('laundry_id'),
            'order_id' => $request->get('order_id'),
            'rate' => $request->get('rate'),
            'review' => $request->get('review'),
        ]);
        return apiResponse("api.success", $data);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories(Request $request)
    {
        $categories = category::where('type', 'category')->oldest()->get();
        $name = 'name_' . App::getLocale();
        $data = [];
        foreach ($categories as $category) {
            $data[] = [
                'id' => $category->id,
                'name' => $category->$name,
                'image' => $category->image,

            ];
        }
        return apiResponse("api.success", $data);
    }


    public function search($name)
    {
        $name1 = 'name_' . App::getLocale();
        $result = Subcategory::with('category')->where($name1, 'LIKE', '%' . $name . '%')->get();
        $data = [];
        if (count($result)) {
            $user = auth('app_users_api')->user();
            foreach ($result as $subcategory) {

                $distance = (!empty($user)) ? getDistanceFirst1($user, $subcategory->lat, $subcategory->lng) : 0;
                $status = getStatus($subcategory);
                $range = $subcategory->range;
                $data[] = [
                    'id' => $subcategory->id,
                    'name' => $subcategory->$name1,
                    'address' => $subcategory->address,
                    'rate' => $subcategory->rate_avg,
                    'is_favorite' => (!empty($user)) ? Favorite::has($subcategory, $user) : false,
                    'image' => $subcategory->image,
                    'lat' => $subcategory->lat,
                    'lng' => $subcategory->lng,
                    'distance' => round($distance, 2),
                    'around_clock' => $subcategory->around_clock,
                    'from' => $subcategory->clock_at,
                    'to' => $subcategory->clock_end,
                    'status' => $status,
                    'distance_class' =>  getDistanceClass($distance, $range),
                    'distance_class_id' =>  getDistanceClassId($distance, $range),
                    'review' => $subcategory->rates
                ];
            }

            return apiResponse('api.success_search', $data);
        } else {
            return apiResponse('api.error_search', $data);
        }
    }

    public function getSubCategoriesProducts($id, $urgent)
    {
        $name = 'name_' . App::getLocale();
        if ($urgent == '0') {
            $subCategoriesServices = CategoryItem::query()->with(['subcategories', 'products' => function ($q) {
                return $q->select('id', 'category_item_id', 'name_' . App::getLocale(), 'desc_' . App::getLocale(), 'image')
                    ->with(['productService' => function ($q) {
                        return $q->select('id', 'product_id', 'services')->selectRaw('price + commission as price');

                    }]);
            }])->where('subcategory_id', $id)->get();
        } elseif ($urgent == 1) {
            $subCategoriesServices = CategoryItem::query()->with(['subcategories', 'products' => function ($q) {
                return $q->select('id', 'category_item_id', 'name_' . App::getLocale(), 'desc_' . App::getLocale(), 'image')
                    ->where('urgentWash',1)
                    ->with(['productService' => function ($q) {

                        return $q->select('id', 'product_id', 'services')->selectRaw('priceUrgent + commission as price');
                    }]);
            }])->where('subcategory_id', $id)->get();
        }

        $subcategory = Subcategory::findorfail($id);
        $data = [];
        $data1 = [];

        $user = auth('app_users_api')->user();
        if ($subCategoriesServices) {
            if (isset($subcategory)) {
                $data1 = [
                    'subcate_id' => $subcategory->id,
                    'name' => $subcategory->$name,
                    'is_favorite' => (!empty($user)) ? Favorite::has($subcategory, $user) : false,
                    'lat' => $subcategory->lat,
                    'lng' => $subcategory->lng,
                    'from' => $subcategory->clock_at,
                    'to' => $subcategory->clock_end,
                    'status' => getStatus($subcategory),
                    'opened'=>$subcategory->around_clock==1 ?'مفتوح': ($subcategory->getIsOpenAttribute() ?'مفتوح':'مغلق'),
                ];
                foreach ($subCategoriesServices as $subcategoryproduct) {
                    $data[] = [
                        'id' => $subcategoryproduct->id,
                        'category_type' => $subcategoryproduct->category_type,
                        'product' => $subcategoryproduct->products,
                    ];
                }
                return apiResponse1("api.success", $data1, $data);
            } else {
                return apiResponse1("api.errors", $data1, $data);
            }
        } else {
            return apiResponse1("api.errors", $data1, $data);
        }
    }

    public function getCarpetLaundryTimes($id)
    {

        $carpetCategoryTimes=carpetLaundryTime::where('subCategory_id',$id)->get();

        foreach ($carpetCategoryTimes as $carpetCategoryTime ){
            $data []=[
                'id'=>$carpetCategoryTime->id,
                'laundry_id'=>$carpetCategoryTime->subCategory_id,
                'startTime'=>$carpetCategoryTime->start_from,
                'endTime'=>$carpetCategoryTime->end_to,
                'serviceType'=>$carpetCategoryTime->service_type,
            ];
        }


        return apiResponse2( $data);
    }

    public function getCarpetLaundries()  {
        $result = carpetLaundry::get();
        $data = [];
        if (count($result)) {
            $user = auth('app_users_api')->user();
            foreach ($result as $carpetLaundry) {

                $distance = (!empty($user)) ? getDistanceFirst1($user, $carpetLaundry->lat, $carpetLaundry->lng) : 0;

                $range = $carpetLaundry->range;
                $data[] = [
                    'id' => $carpetLaundry->id,
                    'approximate_duration' => $carpetLaundry->approximate_duration,
                    'range' => $carpetLaundry->range,
                    'delivery_price' => $carpetLaundry->delivery_price,
                    'distance_class' =>  getDistanceClass($distance, $range),
                    'distance_class_id' =>  getDistanceClassId($distance, $range),
                ];
            }

            return apiResponse('api.in_area', $data);
        } else {
            return apiResponse('api.out_area', $data);
        }

    }
}
