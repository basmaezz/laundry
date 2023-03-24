<?php

namespace App\Http\Controllers\API;

use App;
use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\BankAccount;
use App\Models\Banner;
use App\Models\Branche;
use App\Models\Cart;
use App\Models\CartExtra;
use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\Coupon;
use App\Models\CouponShopCart;
use App\Models\MoneyAccount;
use App\Models\Notifications;
use App\Models\Order;
use App\Models\OrderAdditional;
use App\Models\OrderDetails;
use App\Models\OrderTable;
use App\Models\Package;
use App\Models\Product;
use App\Models\ProductService;
use App\Models\ProviderExtra;
use App\Models\Rate;
use App\Models\RequestDelivery;
use App\Models\SearchHistory;
use App\Models\Subcategory;
use App\Models\UserAddress;
use App\Models\UserDate;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Maize\Markable\Models\Favorite;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**  public function main_user . */
    public function main_user()
    {
        $banners = Banner::pluck('image')->toArray();
        $category = category::where('type', 'category')->oldest()->get();
        $store = category::where('type', 'store')->oldest()->get();

        $categories = $category->toBase()->merge($store);
        $name = 'name_' . App::getLocale();
        $data = [];

        foreach ($categories as $category) {
            $data [] = [
                'id' => $category->id,
                'name' => $category->$name,
                'type' => $category->type,
                'image' => $category->image,
            ];
        }

        return response()->json(['value' => '1', 'key' => "success", 'banners' => $banners, 'categories' => $data]);
    }

    public function getNotification(){
        $app_user_id = auth('app_users_api')->user()->id;
        $notifications = Notifications::where('app_user_id',$app_user_id)->with('order')->latest()->limit(50)->get();
        $_data = [];
        /*foreach ($notifications as $k=>$notification){
            $_data[$k] = $notification;
            if($notification->order_id) {
                $order = OrderTable::find($notification->order_id);
                $_data[$k]['order'] = OrderController::orderObject($order);
            }
        }*/
        return apiResponse('api.notification', ['data' => $notifications]);
    }

    public function makeNotificationRead($id){
        $app_user_id = auth('app_users_api')->user()->id;
        $notifications = Notifications::where([
            'app_user_id' => $app_user_id,
            'id' => $id
        ])->update(['seen' => 1]);
        return apiResponse('api.notification', ['data' => $notifications]);
    }

    public function delete_reason(){
        $reasons = config('setting.delete_reason');
        return apiResponse('api.success', $reasons);
    }

    public function deleteAccount(Request $request){
        $validator = Validator::make($request->all(), [
            'reason_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toArray(), 422);
        }
        $app_user = auth('app_users_api')->user();

        App\Models\DeleteReason::create([
            'app_user_id' => $app_user->id,
            'reason_id' => $request->get("reason_id"),
            'other' => $request->get("other"),
            'attributes' => $app_user->toJson(JSON_PRETTY_PRINT)
        ]);
        $app_user->delete();
        return apiResponse('api.success', ['Account is deleted']);
    }
    public function OrdersAfterCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_coupon' => 'required|exists:coupon_shop_carts,code_name',
        ]);

        $app_user_id = auth('app_users_api')->user()->id;
        $coupon = CouponShopCart::where('code_name', $request->code_coupon)->
        where(function($query) {
            $query->where('date_from','<=',Carbon::now())->where('date_to','>=',Carbon::now())
                ->orWhere(function($query2) {
                    $query2->whereNull('date_from')->orWhereNull('date_to');
                });
        })->first();

        $name = 'name_' . App::getLocale();
        $orders = OrderTable::where('app_user_id', $app_user_id)->with(['orderDetails', 'orderDetails.product'])->get();
        $data = [];
        if (isset($orders)) {
            foreach ($orders as $order) {
                $product = ProductService::where('product_id', $order['product_id'])->first();
                $orderDetail = OrderDetails::Where('order_table_id', $order->id)->first();

                if ($request->has('code_coupon')) {
                    $code_name = request('code_coupon');
                    $code_name = is_unique2('code_name', $code_name);
                    if ($code_name) {
                        if ($order->discount_value) {
                            array_push($data, [
                                'order_id' => $order->id,
                                'laundry name' => $order->subCategories->$name,
                                'total_price' => (int)$orderDetail->price,
                                'total_price_after_add_coupon' => ((int)$orderDetail->price) - ($coupon->discount_value * 100) ,
//                                'total_price_after_add_coupon' => ((int)$order->total_price) - ($coupon->discount_value * 100) / 100,
                            ]);
                        } else {
                            array_push($data, [
                                'order_id' => $order->id,
                                'laundry name' => $order->subCategories->$name,
                                'total_price' => (int)$orderDetail->price,
                            ]);
                        }
                    } else {
                        return apiResponseCouponError('api.Coupon_Not_Exists');
                    }
                } else {
                    if ($order->discount_value) {
                        array_push($data, [
                            'order_id' => $order->id,
                            'laundry name' => $order->subCategories->$name,
                            'total_price' => (int)$orderDetail->price,
                        ]);
                    } else {
                        array_push($data, [
                            'order_id' => $order->id,
                            'laundry name' => $order->subCategories->$name,
                            'total_price' => (int)$orderDetail->price,
                        ]);
                    }
                }
            }
            return apiResponse('api.My_Order', $data);
        } else {
            return apiResponse('api.incorrect_data');
        }
    }

//    public function ordersFees(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'order_id' => 'required|exists:order_tables,id',
//            'laundry_id' => 'required|exists:subcategories,id',
//        ]);
//
//        if ($validator->passes()) {
//            $user = auth('app_users_api')->user();
//            $laundry = Subcategory::where('id', $request->laundry_id)->first();
//
//            $distance = getDistanceFirst1($user, $laundry->lat, $laundry->lng);
//
//            $order = OrderTable::find($request->order_id);
//            if ($distance == 0 || $distance <= 10) {
//
//                $order->update([
//                    'delivery_fees' => 10,
//                    'vat' => 10,
//                ]);
//                $message = 'Values After Calc Vat And Fees';
//            } elseif ($distance == 10 || $distance <= 20) {
//
//                $order->update([
//                    'delivery_fees' => 20,
//                    'vat' => 20,
//                ]);
//
//                $message = 'Values After Calc Vat And Fees';
//            } else {
//                $order->update([
//                    'total_price' => 0,
//                    'total_price_after_add_coupon' => 0,
//                ]);
//                $message = 'out of distance';
//            }
//
//            $data = [
//                'order_id' => $order->id,
//                'delivery_fees' => $order->delivery_fees,
//                'vat' => $order->vat,
//                'total_price_after_add_coupon' => (int)($order->total_price),
//                'total_price' => $order->total_price + $order->delivery_fees,
//            ];
//            return apiResponse($message, $data);
//        }
//
//    }

    public function addToFavorite($id)
    {
        $subCategories = Subcategory::findorfail($id);

        if (isset($subCategories)) {
//          Config::set('markable.user_model' , App\Models\AppUser::class);
            Favorite::add($subCategories, auth('app_users_api')->user());
            $data = [
                'id' => $subCategories->id,
                'is_favorite' => true,
            ];
            return apiResponse('api.added_favorite', $data);
        }

        return responseJsonError(trans('api.data_incorrect'));

    }

    public function removeFromFavorite($id)
    {
        $subCategories = Subcategory::findorfail($id);

        if (isset($subCategories)) {
            Favorite::remove($subCategories, auth('app_users_api')->user());
            $data = [
                'id' => $subCategories->id,
                'is_favorite' => false,
            ];
            return apiResponse('api.removed_favorite', $data);
        }

        return responseJsonError(trans('api.data_incorrect'));

    }

    public function getMyFavorites()
    {
        $user = auth('app_users_api')->user();
        $favorites = Favorite::where([
            'user_id' => $user->id,
            'markable_type' => 'App\Models\Subcategory'
        ])->get();
        $name = 'name_' . App::getLocale();
        $data = [];

        foreach ($favorites as $favorite) {
            $subcategory = Subcategory::where('id',$favorite->markable_id)->first();
            if($subcategory) {
                $distance = getDistanceFirst1($user, $subcategory->lat, $subcategory->lng);
                $data [] = [
                    'id' => $subcategory->id,
                    'name' => $subcategory->$name,
                    'address' => $subcategory->address,
                    'rate' => $subcategory->rate_avg,
                    'is_favorite' => true,
                    'image' => $subcategory->image,
                    'lat' => $subcategory->lat,
                    'lng' => $subcategory->lng,
                    'distance' => round($distance, 2)
                ];
            }
        }

        return apiResponse("api.success", $data);
    }


    public function addTosearch($id)
    {
        $subcategory = Subcategory::find($id);
        $name = 'name_' . App::getLocale();
        $data = [];
        $user = AppUser::first();

        try {
            if (isset($subcategory) && count($subcategory) > 0) {
                $history = new SearchHistory();
                $history->subcategory_id = $subcategory->id;
                $history->save();
                $distance = getDistanceFirst1($user, $subcategory->lat, $subcategory->lng);
                $data [] = [
                    'id' => $subcategory->id,
                    'name' => $subcategory->$name,
                    'address' => $subcategory->address,
                    'rate' => $subcategory->rate,
                    'is_favorite' => $subcategory->is_favorite,
                    'image' => $subcategory->image,
                    'lat' => $subcategory->lat,
                    'lng' => $subcategory->lng,
                    'distance' => round($distance, 2)
                ];
                return apiResponse('api.success_added_to_search', $data);
            } else {
                return apiResponse('api.error_added_to_search', $data);
            }
        } catch (\Exception $e) {
            return apiResponse('api.there_is_error', $data);
        }

    }

    public function getHistory()
    {
        $result = SearchHistory::with(['subcategories'])->get();
        $name = 'name_' . App::getLocale();
        $data = [];
        $user = AppUser::first();
        if (count($result)) {
            foreach ($result as $subcategory) {
                $distance = getDistanceFirst1($user, $subcategory->subcategories->lat, $subcategory->subcategories->lng);
                $data [] = [
                    'id' => $subcategory->subcategories->id,
                    'name' => $subcategory->subcategories->$name,
                    'address' => $subcategory->subcategories->address,
                    'rate' => $subcategory->subcategories->rate,
                    'is_favorite' => $subcategory->subcategories->getIsFavorite(),
                    'image' => $subcategory->subcategories->image,
                    'lat' => $subcategory->subcategories->lat,
                    'lng' => $subcategory->subcategories->lng,
                    'distance' => round($distance, 2)
                ];
            }
            return apiResponse('api.success_search', $data);
        } else {
            return apiResponse('api.error_search', $data);
        }
    }

    public function clearSearchHistorybyId($id)
    {
        $clearHistory = SearchHistory::findorfail($id);
        if (isset($clearHistory)) {
            $data = $clearHistory->delete();
            return apiResponse('api.History_are_cleared', $data);
        }
        return responseJsonError(trans('api.there_is_no_data_to_clear_it'));

    }

    public function clearSearchHistory()
    {
        $searchHistory = SearchHistory::all();
        if (isset($searchHistory)) {
            $data = $searchHistory->each->delete();
            return apiResponse('api.History_are_cleared', $data);
        }
        return responseJsonError(trans('api.there_is_no_data_to_clear_it'));
    }

    /**  public function category providers . */
    public function category_providers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->passes()) {

            $providers_ids = Product::where('category_id', $request->category_id)->pluck('app_user_id')->unique();

            $get_providers = User::where(['user_type' => 'provider', 'confirm' => 1, 'active' => 1])->whereIn('id', $providers_ids);


            $providers = getDistanceHaving($get_providers, $request->lat, $request->lng, setting()->distance_range);

            $data = [];

            foreach ($providers as $provider) {

                $data [] = [
                    'id' => $provider->id,
                    'avatar' => assetsUpload() . '/users_avatar/' . $provider->avatar,
                    'name' => $provider->name,
                    'favorite' => is_favorite($provider->id),
                    'address' => $provider->address,
                    'distance' => round($provider->distance),
                ];
            }

            return responseJsonData($data);
        }

        return response()->json($validator->errors());
    }

    /**  public function category products .*/
    public function category_products(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'provider_id' => 'required',
            'mac_address_id' => 'required',
            'subcategory_id' => 'nullable',
        ]);

        if ($validator->passes()) {

            $category = Category::find($request->category_id);

            if (!isset($category)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            $user_data = ['app_user_id' => $request->provider_id, 'category_id' => $request->category_id];

            $subcategory_ids = Product::where($user_data)->pluck('subcategory_id')->unique();

            $subcategories = Subcategory::whereIn('id', $subcategory_ids)
                ->where(['category_id' => $category->id, 'deleted' => 0])
                ->select('id', 'name_' . App::getLocale() . ' as name')->get();

            $subcategories->prepend(['id' => 0, 'name' => trans('api.all')]);


            if (isset($request->subcategory_id) && $request->subcategory_id != 0) {

                $_products = Product::where($user_data + ['subcategory_id' => $request->subcategory_id]);

            } else {

                $_products = Product::where($user_data);
            }

            if (isset($request->sort)) {

                $_products = $request->sort == 'latest' ? $_products->orderBy('created_at') : $_products->orderByDesc('created_at');
            }

            $products = $_products->latest()->get();

            $data = get_products($products, 1, $category, $request->mac_address_id, $request->provider_id);

            $cart = total_cart($request->mac_address_id, $category->id, $request->provider_id);

            $order_id = isset($cart['order_id']) ? $cart['order_id'] : 0;

            return response()->json(["value" => "1", "key" => "success",
                "subcategories" => $subcategories,
                "data" => $data,
                "pieces" => $cart['pieces'],
                "total" => $cart['total'],
                "order_id" => $order_id]);
        }

        return response()->json($validator->errors());
    }

    public function order_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'app_user_id' => 'required|exists:app_users,id',
        ]);

        if ($validator->passes()) {


            $user = JWTAuth::toUser()->id;

            $order = Order::where(['app_user_id' => $user, 'id' => $request->order_id])->first();

            if (!isset($order)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            if (isset($request->action) && $request->action == "completed") {

                $order->update(['status' => $request->action]);
            }

            $rate = Rate::where(['app_user_id' => $user, 'order_id' => $order->id])->first();

            $format = format_arabic($order->delivery_date);
            $data['status'] = $order->status;
            $data['category'] = $order->category->type;
            $data['products'] = carts($order);
            $data['id'] = $order->id;
            $data['total'] = $order->final_total;
            $data['is_rate'] = isset($rate) ? 1 : 0;
            $data['date'] = date("d/m/Y", strtotime($order->delivery_date));
            $data['time'] = date("h:i ", strtotime($order->delivery_date)) . $format;
            $avatar = assetsUpload() . '/users_avatar/' . $order->delegate->avatar;

            $data['delegate_avatar'] = isset($order->delegate_id) ? $avatar : '';
            $data['delegate_name'] = isset($order->delegate_id) ? $order->delegate->name : '';
            $data['delegate_phone'] = isset($order->delegate_id) ? $order->delegate->phone : '';

            return responseJsonData($data);
        }

        return response()->json($validator->errors());
    }

    /**  public function request delivery . */
    public function request_delivery(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'category_id' => 'required',
            'bill_number' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'date' => 'required',
            'time' => 'required',
            'notes' => 'nullable',
        ]);

        if ($validator->passes()) {

            $dataExcept = $request->all();

            $dataExcept['app_user_id'] = JWTAuth::toUser()->id;

            RequestDelivery::create($dataExcept);

            return responseJsonData(trans('api.send_request'));
        }

        return response()->json($validator->errors());
    }

    /**  public function favorite . */
    public function favorite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider_id' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->passes()) {

            #check product is exist
            $provider = User::find($request->provider_id);
            $user = JWTAuth::toUser();

            if (!isset($provider)) {
                return responseJsonError(trans('api.data_incorrect'));
            }

            $favorite = Favorite::where(['app_user_id' => $user->id, 'provider_id' => $provider->id])->first();

            if (isset($favorite)) {

                $favorite->delete();
                $msg = trans('api.removed_favorite');
                $data = 0;

                return responseDataMessage($msg, $data);

            } else

                Favorite::create([
                    'app_user_id' => $user->id,
                    'provider_id' => $provider->id,
                    'category_id' => $request->category_id,
                ]);

            $msg = trans('api.added_favorite');
            $data = 1;

            return responseDataMessage($msg, $data);
        }

        return response()->json($validator->errors());
    }

    /**  public function my favorites . */
    public function my_favorites(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->passes()) {

            $user = JWTAuth::toUser();
            $name = 'name_' . App::getLocale();
            $favorites = Favorite::where('app_user_id', $user->id)->with('provider')->latest()->get();
            $data = [];

            foreach ($favorites as $favorite) {

                $provider = User::where('id', $favorite->provider_id);
                $distance = getDistanceFirst($provider, $request->lat, $request->lng);

                $data [] = [
                    'id' => $favorite->provider_id,
                    'avatar' => assetsUpload() . '/users_avatar/' . $favorite->provider->avatar,
                    'name' => $favorite->provider->name,
                    'category_id' => $favorite->category_id,
                    'category' => $favorite->category->$name,
                    'address' => $favorite->provider->address,
                    'distance' => round($distance->distance),
                ];
            }

            return responseJsonData($data);

        }

        return response()->json($validator->errors());
    }

    /**  public function notifications . */
    public function notifications()
    {
        $JwtUser = JWTAuth::toUser();
        $notifications = Notifications::where('app_user_id', $JwtUser->id)->latest()->get();
        $content = 'content_' . App::getLocale();
        $data = [];

        foreach ($notifications as $notification) {

            $data [] = [
                'id' => $notification->id,
                'content' => $notification->$content,
                'created' => $notification->created_at->diffForHumans(),
                'type' => $notification->type,
                'order_id' => isset($notification->order_id) ? $notification->order_id : 0,
            ];
        }

        Notifications::where('app_user_id', $JwtUser->id)->update(['seen' => 1]);

        return responseJsonData($data);
    }

    /**  public function count notifications . */
    public function count_notification()
    {
        $JwtUser = JWTAuth::toUser();
        $notifications = Notifications::where(['app_user_id' => $JwtUser->id, 'seen' => 0])->count();

        return responseJsonData($notifications);
    }

    /**  public function delete notifications . */
    public function delete_notification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notification_id' => 'required',
        ]);

        if ($validator->passes()) {

            $JwtUser = JWTAuth::toUser();
            $notification = Notifications::where(['id' => $request->notification_id, 'app_user_id' => $JwtUser->id])->first();

            if (!isset($notification)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            $notification->delete();

            return responseJsonData(trans('api.deleted_successfully'));
        }

        return response()->json($validator->errors());
    }

    /**  public function user details order . */
    public function user_details_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'action' => 'nullable',
        ]);

        if ($validator->passes()) {

            $user = JWTAuth::toUser()->id;
            $order = Order::where(['app_user_id' => $user, 'id' => $request->order_id])->first();

            if (!isset($order)) {
                return responseJsonError(trans('api.data_incorrect'));
            }

            if (isset($request->lat) && isset($request->lng)) {

                $order->update([
                    'address' => $request->address,
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                ]);
            }

            $data['address'] = $order->address;
            $data['total'] = $order->total;
            $data['tax'] = $order->total_tax;
            $data['delivery'] = $order->total_delivery;
            $data['price_urgent'] = isset($order->urgent_price) ? $order->urgent_price : '';
            $data['total_additional'] = $order->total_additional;
            $data['final_total'] = $order->final_total;

            return responseJsonData($data);
        }

        return response()->json($validator->errors());
    }

    /**  public function delete add address . */
    public function add_address(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:home,work,rest',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ], [
            'type.in' => 'Type Must Be [ home - work - rest ]',
        ]);

        if ($validator->passes()) {

            $dataExcept = $request->all();
            $dataExcept['app_user_id'] = JWTAuth::toUser()->id;

            UserAddress::create($dataExcept);

            return responseJsonData(trans('api.add_successfully'));
        }

        return response()->json($validator->errors());
    }

    /**  public function user addresses . */
    public function user_addresses()
    {
        $user = JWTAuth::toUser()->id;

        $addresses = UserAddress::where('app_user_id', $user)->select('id', 'type', 'address', 'lat', 'lng')->get();

        return responseJsonData($addresses);
    }

    /**  public function delete address . */
    public function delete_address(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
        ]);

        if ($validator->passes()) {

            $user = JWTAuth::toUser()->id;

            $address = UserAddress::where(['id' => $request->address_id, 'app_user_id' => $user])->first();

            if (!isset($address)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            $address->delete();

            return responseJsonData(trans('api.deleted_successfully'));
        }

        return response()->json($validator->errors());
    }

    /**  public function product services . */
    public function product_services(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'mac_address_id' => 'required',
        ]);

        if ($validator->passes()) {

            $product = Product::find($request->product_id);

            if (!isset($product)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            $branch = Branche::where('deleted', 0)->first();

//            $branche  = getDistance($branches,$request->lat,$request->lng);

            $data = product_services($product->id, $branch, 'service', $request->mac_address_id);

            return responseJsonData($data);
        }

        return response()->json($validator->errors());
    }

    /**  public function product details . */
    public function product_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->passes()) {

            $product = Product::find($request->product_id);

            if (!isset($product)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            $branches = Branche::where('deleted', 0)->newQuery();

            $branche = getDistance($branches, $request->lat, $request->lng);

            $price = product_services($product->id, $branche, 'price');

            $name = 'name_' . App::getLocale();
            $desc = 'desc_' . App::getLocale();

            $JwtToken = JWTAuth::getToken();

            if ($JwtToken) {

                $user = JWTAuth::toUser();
                $favorite = Favorite::where(['app_user_id' => $user->id, 'product_id' => $product->id])->first();
            }

            $data['images'] = product_images($product->id, 'images');
            $data['name'] = $product->$name;
            $data['desc'] = $product->$desc;
            $data['price'] = $price;
            $data['favorite'] = isset($JwtToken) && isset($favorite) ? 1 : 0;
            $data['count'] = 0;

            return responseJsonData($data);
        }

        return response()->json($validator->errors());
    }

    /**  public function category_additionals . */
    public function category_additionals(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider_id' => 'required|exists:users,id',
            'category_id' => 'required',
        ]);

        if ($validator->passes()) {

            $category = Category::find($request->category_id);

            if (!isset($category)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            $dateExtra = ['provider_id' => $request->provider_id, 'category_id' => $category->id];
            $extras = ProviderExtra::where($dateExtra)->pluck('cart_extra_id', 'cart_extra_id')->toArray();
            $additionals = CartExtra::whereIn('id', $extras)->latest()->get();

            $name = 'name_' . App::getLocale();
            $data = [];

            foreach ($additionals as $additional) {

                $data [] = [
                    'id' => $additional->id,
                    'name' => $additional->$name,
                    'extras' => extras($additional->id, $request->provider_id),
                ];
            }

            return responseJsonData($data);
        }

        return response()->json($validator->errors());
    }

    /**  public function add order . */

    public function add_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'provider_id' => 'required|exists:users,id',
            'category_id' => 'required',
            'received_date' => 'nullable',
            'delivery_date' => 'nullable',
            'address' => 'required',
            'lng' => 'required',
            'lat' => 'required',
            'notes' => 'nullable',
            'total' => 'nullable',
            'final_total' => 'nullable',
            'total_tax' => 'nullable',
            'total_delivery' => 'nullable',
            'services' => 'required',
            'total_additional' => 'nullable',
            'additionals' => 'nullable',
        ]);

        if ($validator->passes()) {

            $order = Order::find($request->order_id);

            $category = Category::find($request->category_id);

            $branches = Branche::where('deleted', 0)->newQuery();

            $branche = getDistance($branches, $request->lat, $request->lng);


            if (!isset($order)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            if (!isset($category)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            $dateExtra = ['provider_id' => $request->provider_id, 'category_id' => $category->id];
            $extras = ProviderExtra::where($dateExtra)->pluck('cart_extra_id', 'cart_extra_id')->toArray();
            $additionals = CartExtra::whereIn('id', $extras)->latest()->get();

            $name = 'name_' . App::getLocale();
            $data = [];

            foreach ($additionals as $additional) {

                $data [] = [
                    'id' => $additional->id,
                    'name' => $additional->$name,
                    'extras' => extras($additional->id, $request->provider_id),
                ];
            }

            $dataExcept = Arr::except($request->all(), ['additionals', 'services', 'order_id']);

            $dataExcept['app_user_id'] = JWTAuth::toUser()->id;

            if (isset($request->final_total)) {

                $dataExcept['status'] = 'pending';
                $dataExcept['branche_id'] = $branche->id;
            }

            $order->update($dataExcept);

            if (isset($request->services)) {

                $services = json_decode($request->services, true);

                foreach ($services as $service) {

                    if ($service['count'] > 0) {

                        Cart::create([
                            'order_id' => $order->id,
                            'product_id' => $service['product_id'],
                            'service_id' => $service['service_id'],
                            'price' => $service['price'],
                            'count' => $service['count'],
                        ]);
                    }
                }
            }

            if (isset($request->additionals)) {

                $additionals = json_decode($request->additionals, true);

                foreach ($additionals as $additional) {
                    OrderAdditional::create([
                        'order_id' => $order->id,
                        'extra_id' => $additional['extra_id'],
                        'price' => $additional['price'],
                    ]);
                }
            }

            $cart = total_cart($order->mac_address_id, $category->id, $request->provider_id);

            return response()->json(["value" => "1", "key" => "success",
                'carts' => carts($order),
                'total' => $cart['total'],
                'delivery' => setting()->delivery_price,
                'tax' => setting()->added_tax,
                'urgent' => (int)$order->provider->urgent,
                'delivery_price' => setting()->delivery_price,
                'price_urgent' => isset($order->provider->price_urgent) ? $order->provider->price_urgent : '',
                "additionals" => $data,
            ]);
        }

        return response()->json($validator->errors());
    }

    /**  public function discount code . */
    public function discount_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'discount_code' => 'required',
        ]);

        if ($validator->passes()) {

            $JwtUser = JWTAuth::toUser();

            $order = Order::where(['app_user_id' => $JwtUser->id, 'id' => $request->order_id])->first();

            if (!isset($order)) {

                return responseJsonError(trans('api.order_not_exists'));
            }

            $discount = Coupon::where(['code_name' => $request->discount_code, 'app_user_id' => $order->provider_id])->first();

            if (!isset($discount)) {
                return responseJsonError(trans('api.discount_not_exist'));
            }

            $checkCode = Order::where(['app_user_id' => $JwtUser->id, 'coupon' => $discount->code_name])->get();

            if (!$checkCode->isEmpty()) {
                return responseJsonError(trans('api.discount_expired'));
            }

            $total = $order->total;
            $discountOrder = $total * $discount->discount / 100;
            $totalOrder = $total - $discountOrder;
            $final_total = $totalOrder + $order->total_additional + $order->total_tax;

            if (isset($request->confirm) && $request->confirm == 1) {

                $order->total = (int)$totalOrder;
                $order->final_total = $final_total;
                $order->coupon = $discount->code_name;
                $order->discount = $discountOrder;
                $order->update();
            }

            $data['total'] = (string)$order->total;
            $data['delivery'] = (string)$order->delivery;
            $data['discount'] = $discount->discount;
            $data['after_discount'] = $totalOrder;
            $data['final_total'] = $final_total;

            return response()->json(['value' => '1', 'key' => 'success', 'data' => $data]);

        }
        return response()->json($validator->errors());
    }

    /**  public function product details . */
    public function add_to_cart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mac_address_id' => 'required',
            'provider_id' => 'required',
            'category_id' => 'required',
            'services' => 'required',
        ]);

        if ($validator->passes()) {

            $order = Order::firstOrNew([
                'mac_address_id' => $request->mac_address_id,
                'category_id' => $request->category_id,
                'provider_id' => $request->provider_id,
                'status' => 'cart',
            ]);

            $order->mac_address_id = $request->mac_address_id;
            $order->category_id = $request->category_id;
            $order->provider_id = $request->provider_id;
            $order->save();

            if (isset($request->services)) {
                $services = json_decode($request->services, true);

                foreach ($services as $service) {

                    if ($service['count'] > 0) {

                        $cart = Cart::create([
                            'order_id' => $order->id,
                            'product_id' => $service['product_id'],
                            'service_id' => isset($service['service_id']) ? $service['service_id'] : null,
                            'price' => $service['price'],
                            'count' => $service['count'],
                            'notes' => $request->notes,
                        ]);

//                        $cart->order_id    = $order->id;
//                        $cart->product_id  = $service['product_id'];
//                        $cart->service_id  = $service['service_id'];
//                        $cart->price       = $service['price'];
//                        $cart->count       = $service['count'];
//                        $cart->notes       = $request->notes;
//
//                        $cart->save();
                    }
                }
            }

            return responseDataMessage(trans('api.add_to_cart'), $order->id);
        }

        return response()->json($validator->errors());
    }

    /**  public function costs . */
    public function costs()
    {
        $data['delivery_price'] = setting()->delivery_price;
        $data['tax'] = setting()->added_tax;

        return responseJsonData($data);
    }

    /**  public function payment order . */
    public function payment_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'payment' => 'required',
            'amount' => 'required_if:payment,==,bank',
            'bank_name' => 'required_if:payment,==,bank',
            'image' => 'required_if:payment,==,bank',
        ]);

        if ($validator->passes()) {

            $user = JWTAuth::toUser();

            $order = Order::where(['app_user_id' => $user->id, 'id' => $request->order_id])->first();

            if (!isset($order)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            if ($request->payment == 'bank') {

                MoneyAccount::create([
                    'name' => $user->name,
                    'app_user_id' => $user->id,
                    'order_id' => $order->id,
                    'bank_name' => $request->bank_name,
                    'amount' => $request->amount,
                    'image' => uploadFile($request->image, 'transfer_images'),
                    'type' => 'order',
                ]);
            }

            $order->update(['payment' => $request->payment, 'status' => 'current']);

            $msg_ar = ' لديك طلب جديد -  ' . $order->id;
            $msg_en = 'You have a new order - ' . $order->id;

            FcmNotification($order->id, $msg_ar, $msg_en, $order->provider_id);

            $allDelegates = User::where(['user_type' => 'delegate', 'active' => 1]);

            $delegates = getDistanceHaving($allDelegates, $order->lat, $order->lng, setting()->distance_delegates);

            if ($delegates->isEmpty()) {

                return responseJsonError(trans('api.delegates_unavailable'));
            }

            foreach ($delegates as $delegate) {

                $msg = 'لديك طلب توصيل جديد';
                $msg_en = 'You have a new delivery order';

                FcmNotification($order->id, $msg, $msg_en, $delegate->id, 'order');
            }

            $pluck_id = $delegates->pluck('id')->toArray();

            $order->update(['delegates' => $pluck_id]);

            return responseJsonData(trans('api.payment_successfully'));

        }
        return response()->json($validator->errors());
    }

    /**  public function payment delivery . */
    public function payment_delivery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'payment' => 'required',
            'amount' => 'required_if:payment,==,bank',
            'bank_name' => 'required_if:payment,==,bank',
            'image' => 'required_if:payment,==,bank',
        ]);

        if ($validator->passes()) {

            $user = JWTAuth::toUser();
            $order = Order::where(['app_user_id' => $user->id, 'id' => $request->order_id])->first();

            if (!isset($order)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            $allDelegates = User::where(['user_type' => 'delegate', 'active' => 1,'available'=>1]);
            $delegates = getDistanceHaving($allDelegates, $order->lat, $order->lng, setting()->distance_delegates);

            if ($delegates->isEmpty()) {

                return responseJsonError(trans('api.delegates_unavailable'));
            }

            if ($request->payment == 'bank') {

                MoneyAccount::create([
                    'name' => $user->name,
                    'app_user_id' => $user->id,
                    'order_id' => $order->id,
                    'bank_name' => $request->bank_name,
                    'amount' => $request->amount,
                    'image' => uploadFile($request->image, 'transfer_images'),
                    'type' => 'order',
                ]);
            }

            foreach ($delegates as $delegate) {

                $msg = 'لديك طلب توصيل جديد - ' . $order->id;
                $msg_en = 'You have a new delivery request - ' . $order->id;

                FcmNotification($order->id, $msg, $msg_en, $delegate->id, 'order');
            }

            $pluck_id = $delegates->pluck('id')->toArray();

            $order->update(['delegates' => $pluck_id, 'status' => 'delivery_order', 'delivery_price' => setting()->delivery_price]);

            $order->increment('total_delivery', setting()->delivery_price);

            $order->increment('final_total', setting()->delivery_price);

            return responseJsonData(trans('api.payment_successfully'));

        }
        return response()->json($validator->errors());
    }

    /**  public function user_orders . */
    public function user_orders(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            $orders = Order::where(['app_user_id' => JWTAuth::toUser()->id]);

            $data = [];

            if ($request->status == 'pending_payment') {

                $orders = $orders->where('status', 'pending')->whereNull('payment')->latest()->get();

            } elseif ($request->status == 'completed') {

                $orders = $orders->where('status', $request->status)->latest()->get();

            } else {

                $orders = $orders->whereNotIn('status', ['refuse', 'delegate_refused', 'completed'])
                    ->whereNotNull('payment')->latest()->get();
            }

            foreach ($orders as $order) {

                $format = format_arabic($order->received_date);

                $data [] = [

                    'id' => $order->id,
                    'lat' => $order->lat,
                    'lng' => $order->lng,
                    'address' => $order->address,
                    'username' => $order->provider->name,
                    'image' => assetsUpload() . '/users_avatar/' . $order->provider->avatar,
                    'total' => $order->final_total,
                    'date' => date("d/m/Y", strtotime($order->received_date)),
                    'time' => date("h:i ", strtotime($order->received_date)) . $format,
                ];
            }

            return responseJsonData($data);
        }

        return response()->json($validator->errors());
    }

    /**  public function delete service cart . */
    public function delete_service_cart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_cart_id' => 'required',
        ]);

        if ($validator->passes()) {
            $cart = Cart::find($request->service_cart_id);

            if (!isset($cart)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            $cart->delete();

            return responseJsonData(trans('api.deleted_successfully'));
        }
        return response()->json($validator->errors());
    }

    /**  public function delete order . */
    public function delete_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
        ]);

        if ($validator->passes()) {

            $user = JWTAuth::toUser()->id;
            $order = Order::where(['app_user_id' => $user, 'id' => $request->order_id])->first();

            if (!isset($order)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            $order->delete();

            return responseJsonData(trans('api.deleted_successfully'));
        }

        return response()->json($validator->errors());
    }

    /**  public function packages . */
    public function packages()
    {
        $packages = Package::select('id', 'price', 'days', 'number_orders', 'title_' . App::getLocale() . ' as title',
            'desc_' . App::getLocale() . ' as desc')->where('deleted', 0)->latest()->get();

        return responseJsonData($packages);
    }

    /**  public function package payment . */
    public function package_payment(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'package_id' => 'required',
            'payment_method' => 'required|in:online,bank',
        ], [
            'payment_method.in' => 'Type Must Be [ online - bank ]',
        ]);

        if ($validator->passes()) {

            $package = Package::find($request->package_id);
            $user = JWTAuth::toUser();

            if (!isset($package)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            MoneyAccount::create([
                'name' => $user->name,
                'app_user_id' => $user->id,
                'package_id' => $package->id,
                'bank_name' => $request->payment_method == 'online' ? 'online' : $request->bank_name,
                'amount' => $request->payment_method == 'online' ? $package->price : $request->amount,
                'image' => $request->payment_method == 'online' ? null : uploadFile($request->image, 'transfer_images'),
                'type' => 'subscribe',
            ]);

            if ($request->payment_method == 'bank') {
                $user->update(['subscribe' => 'pending']);
            }

            return responseJsonData(trans('api.waiting_payment'));
        }

        return response()->json($validator->errors());
    }

    /**  public function bank transfers . */
    public function bank_transfers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'nullable',
            'name' => 'nullable',
            'bank_name' => 'nullable',
            'image' => 'nullable',
        ]);

        if ($validator->passes()) {

            $accounts = BankAccount::select('id', 'bank_name', 'account_name', 'account_number', 'iban_number')->latest()->get();

            $JwtUser = JWTAuth::toUser()->id;

            if ($request->name && $request->amount) {

                MoneyAccount::create([
                    'app_user_id' => $JwtUser,
                    'amount' => $request->amount,
                    'name' => $request->name,
                    'bank_name' => $request->bank_name,
                    'type' => 'order',
                    'image' => uploadFile($request->image, 'transfer_images'),
                ]);
            }

            return responseJsonData($accounts);
        }

        return response()->json($validator->errors());
    }

    /**  public function my dates . */
    public function my_dates()
    {
        $user = JWTAuth::toUser();
        $dates = UserDate::where('app_user_id', $user->id)->orderBy('date', 'ASC')->get();

        $data = [];

        foreach ($dates as $date) {
            $data [] = [
                'id' => $date->id,
                'date' => $date->date,
                'time' => $date->time,
            ];
        }

        $subscription = !isset($user->subscribe_end_date) ? 0 : 1;
        $subscribe = new DateTime($user->subscribe_end_date);
        $now = new DateTime();

        if (isset($user->subscribe_end_date) && $now > $subscribe) {

            $msg = trans('api.subscription_expired');
            $subscription = 0;

        } elseif ($user->subscribe == 'pending') {

            $msg = trans('api.subscription_pending');
            $subscription = 1;

        } elseif (isset($user->subscribe_end_date)) {

            $diff = $now->diff($subscribe)->format("%a");

            $msg = trans('api.left_for_you') . $diff . trans('api.day_of_subscription');

        } else {

            $msg = '';
        }

        return response()->json(['value' => '1', 'key' => "success", 'msg' => $msg, 'data' => $data, 'subscription' => $subscription]);
    }

    /**  public function add date . */
    public function add_date(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'time' => 'required',
        ]);

        if ($validator->passes()) {

            $user = JWTAuth::toUser();
            $subscribe = new DateTime($user->subscribe_end_date);
            $date = new DateTime($request->date);

            if (isset($user->subscribe_end_date) && $subscribe < $date) {

                return responseJsonError(trans('api.package_expiry'));
            }

            if (isset($user->package_num_orders) && $user->package_num_orders <= 0) {

                return responseJsonError(trans('api.finish_package_num'));
            }

            $request['app_user_id'] = $user->id;

            UserDate::create($request->all());

            $user->decrement('package_num_orders', 1);

            return responseJsonData(trans('api.add_successfully'));
        }

        return response()->json($validator->errors());
    }

    public function add_rate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'service_rate' => 'required',
            'delegate_rate' => 'required',
        ]);

        if ($validator->passes()) {

            $user = JWTAuth::toUser();
            $order = Order::where(['app_user_id' => $user->id, 'id' => $request->order_id])->first();

            if (!isset($order)) {

                return responseJsonError(trans('api.data_incorrect'));
            }

            $rate = Rate::firstOrNew([
                'app_user_id' => $user->id,
                'order_id' => $order->id,
            ]);

            $rate->user_id = $user->id;
            $rate->order_id = $order->id;
            $rate->service_rate = $request->service_rate;
            $rate->delegate_rate = $request->delegate_rate;
            $rate->save();

            return responseJsonData(trans('api.rate_successfully'));
        }

        return response()->json($validator->errors());
    }

    public function updateDelegateLocation($id,Request $request)
    {
        $this->validate($request, [
            'lat'  => 'required',
            'lng'  => 'required',
        ],[
            'lat.required'    =>'يجب ادخال Lat ',
            'lng.required'    =>'يجب ادخال Lng',
        ]);

        $data=AppUser::where('id',$id)->update($request->except(['_method','_token','id']));
        $data=AppUser::find($id);

        Session::flash('success', 'تم التعديل');
        return apiResponse("api.success", $data);
    }

}
