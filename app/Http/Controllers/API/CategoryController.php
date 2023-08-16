<?php

namespace App\Http\Controllers\API;

use App\Models\AppUser;
use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\CouponShopCart;
use App\Models\OrderDetails;
use App\Models\OrderTable;
use App\Models\ProductService;
use App\Models\RateLaundry;
use App\Models\Subcategory;
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
    public function getShowSubCategories($id)
    {
        if ($id == 1) {
            $subCategories = Subcategory::where('category_id', '1')->get();
        } elseif ($id == 4) {
            $subCategories = Subcategory::where('urgentWash', '1')->get();
        }
        $name = 'name_' . App::getLocale();
        $data = [];

        $user = auth('app_users_api')->user();
        //$user = AppUser::where('id',27)->first();

        foreach ($subCategories as $subcategory) {
            $distance = (!empty($user)) ? distance($user->lat, $user->lng, $subcategory->lat, $subcategory->lng) : 0;
            $range = $subcategory->range;
            $data[] = [
                'id' => $subcategory->id,
                //'user' => $user,
                //'user2' => auth()->user(),
                //'distanceObject' => $distanceObject,
                'name' => $subcategory->$name,
                'address' => $subcategory->address,
                'delivery_fees' => $subcategory->price,
                'urgentWash' => $subcategory->urgentWash,
                'rate' => $subcategory->rate_avg,
                'is_favorite' => (!empty($user)) ? Favorite::has($subcategory, $user) : false,
                'image' => $subcategory->image,
                'location' => $subcategory->location,
                'lat' => $subcategory->lat,
                'lng' => $subcategory->lng,
                'approximate_duration' => $subcategory->approximate_duration,
                'distance' => round($distance, 2),
                'distance' => round($distance, 2),
                'range' => $subcategory->range,
                'distance_class' =>  getDistanceClass($distance, $range),
                'distance_class_id' =>  getDistanceClassId($distance, $range),
                'review' => $subcategory->rates
            ];
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
                       $q=ProductService::pluck('id', 'product_id', 'services', 'price','commission');
                       return $q
//                         $q->select('id', 'product_id', 'services', 'price','commission');
                    }]);
            }])->where('subcategory_id', $id)->get();
        } elseif ($urgent == 1) {
            $subCategoriesServices = CategoryItem::query()->with(['subcategories', 'products' => function ($q) {
                return $q->select('id', 'category_item_id', 'name_' . App::getLocale(), 'desc_' . App::getLocale(), 'image')
                    ->with(['productService' => function ($q) {
                        $q=ProductService::pluck('id', 'product_id', 'services', 'priceUrgent','commission');
                        return $q;
//                        $q->select('id', 'product_id', 'services', 'priceUrgent','commission');
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
}
