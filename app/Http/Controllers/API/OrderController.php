<?php

namespace App\Http\Controllers\API;

use App\Models\AppUser;
use App\Models\CouponShopCart;
use App\Models\OrderDetails;
use App\Models\OrderTable;
use App\Models\ProductService;
use App\Models\RateLaundry;
use App\Models\Subcategory;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    const WaitingForDelivery            = 1;
    const AcceptedByDelivery            = 2;
    //const DeliveryOnWay                 = 3;
    const WayToLaundry                  = 3;
    const DeliveredToLaundry            = 4;
    const ClothesReadyForDelivery       = 5;
    const WaitingForDeliveryToReceiveOrder = 6;
    const AcceptedByDeliveryToYou       = 7;
    //const DeliveryOnTheWayToYou         = 9;
    const Completed                     = 8;
    const Cancel                        = 10;
/*
 * - انتظار المندوب
- المندوب قادم اليك (عند قبول الطلب من قبل المندوب)
- الملابس في الطريق للمغسلة (عند استلام الملابس من المندوب)
- ملابسك في المغسلة وجاري غسيلها (عند تسليم المندوب الملابس للمغسلة)

- ملابسك جاهزة للاستلام، نرجو اختيار طريقة الاستلام ( عند انتهاء المغسلة من غسيل الملابس)
- في انتظار المندوب (عند اختيار توصيل في طريقة الاستلام)
- ملابسك في الطريق (عند قبول المندوب الطلب)
- شكرا لتعاملك معنا وملبوس العافية (عند تسليم المندوب الملابس للعميل)*/
    /**
     * get the order fees
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ordersFees(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'laundry_id' => 'required|exists:subcategories,id',
        ]);

        if ($validator->passes()) {
            $user = auth('app_users_api')->user();
            $laundry = Subcategory::where('id', $request->get('laundry_id'))->first();

            $distance = getDistanceFirst1($user, $laundry->lat, $laundry->lng);
            $data = [
                'delivery_fees' => 0,
                'vat' => config('setting.vat'),
            ];

            if ($distance <= 10) {
                $data['delivery_fees'] = 10;
                $message = trans('api.Values_After_Calc_Vat_And_Fees');
            } elseif ($distance > 10 || $distance <= 20) {
                $data['delivery_fees'] = 20;
                $message = trans('api.Values_After_Calc_Vat_And_Fees');
            } else {
                $message = 'out of distance';
            }

            return apiResponse($message, $data);
        }
        return apiResponse(trans('api.error_validation'), $items=null,500,500);
    }
    /**
     * add new order
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addOrderTable(Request $request)
    {

        $app_user_id = auth('app_users_api')->user()->id;
        $_totalOrders = OrderTable::where('user_id',$app_user_id)->where("status_id",'<',self::Completed)->count();
        if($_totalOrders >= 3){
            return apiResponseCouponError('api.You reached the maximum number or request',400,400);
        }

        $discount_value = 0;

        if ($request->has('coupon')) {
            $coupon = CouponShopCart::where('code_name', $request->get('coupon'))->
            where(function($query) {
                $query->where('date_from','<=',Carbon::now())->where('date_to','>=',Carbon::now())
                    ->orWhere(function($query2) {
                        $query2->whereNull('date_from')->orWhereNull('date_to');
                    });
            })->first();
            if (isset($coupon)) {
                $discount_value = $coupon->discount_value;
            } else {
                return apiResponseCouponError('api.Coupon_Not_Exists');
            }
        }
        $laundry = Subcategory::where('id', $request->get('laundry_id'))->first();
        $distance = getDistanceFirst1(auth('app_users_api')->user(), $laundry->lat, $laundry->lng);
        dd($distance);
        if ($distance <= 10) {
            $delivery_fees = 10;
        } elseif ($distance > 10 || $distance <= 20) {
            $delivery_fees = 20;
        } else {
            $delivery_fees = 30;
        }
        $order_data = [
            'user_id'        => $app_user_id,
            'laundry_id'     => $request->get('laundry_id'),
            'category_item_id'=> $request->get('category_item_id'),
            'payment_method' => $request->get('payment_method','Cash'),
            'address_id'     => $request->get('address_id'),
            'count_products' => count($request->get('items')),
            'note'           => $request->get('note'),
            'status'         => 'Waiting for delivery',
            'status_id'      => self::WaitingForDelivery,
            'total_price'    => 0,
            'discount_value' => $discount_value,
            'delivery_fees'  => $delivery_fees,
            'discount'       => 0,
            'vat'            => 0,
            'coupon'         => $request->get('coupon') ?? null,
        ];

        $order = OrderTable::create($order_data);

        $item_data = null;
        $total = 0;
        $item_quantity = 0;
        foreach ($request->get('items') as $key => $item) {
            $product = ProductService::where('product_id', $item['product_id'])->first();
            if($product) {
                $item_data = [
                    'order_table_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'category_item_id' => $item['category_id'],
                    'product_service_id' => $item['product_service_id'],
                    'quantity' => $item['quantity'],
                    'price' => $product->price * $item['quantity'],
                ];
                $total += $product->price * $item['quantity'];
                $item_quantity += $item['quantity'];
                OrderDetails::create($item_data);
            }
        }

        $order->total_price    = $total;
        $order->count_products = $item_quantity;
        $order->discount       = floatval($total*$discount_value);
        $order->vat            = floatval($total*config('setting.vat'));
        if($request->hasFile('audio_note')) {
            $order->audio_note = uploadFile($request->file("audio_note"), 'audio_note');
        }
        $order->save();

        $orders = OrderTable::where('id', $order->id)->with(['orderDetails' => function ($q) {
            return $q->select('id', 'order_table_id', 'product_id', 'category_item_id', 'price', 'quantity');
        }])->select('id', 'user_id', 'laundry_id')->first();
        $name = 'name_' . App::getLocale();
        $body = __('api.success_send_to_laundry',['laundry'=>$order->subCategories->$name]);
        NotificationController::sendNotification(__('api.success_to_shopping_cart'), $body, auth('app_users_api')->user(),$order->id);

        $distance = (!empty($user))? getDistanceFirst1($user, $laundry->lat, $laundry->lng) : 0;
//        $userLocation = getDistanceFirst1(auth('app_users_api')->user(), $laundry->lat, $laundry->lng);

        $users = AppUser::where([
            'status' => 'active',
            'user_type' => 'delivery',
            'available'=>'1',
            'distance'=>getUserLocation($distance)
        ])->get();
        dd($users);
        foreach ($users as $user) {

            NotificationController::sendNotification(
                'New Delivery Request',
                'New Delivery Request Number #' . $order->id,
                $user,
                $order->id);
        }
        return apiResponseOrders1('api.success_to_shopping_cart', $orders);
    }

    /**
     * Check Coupon is exist and valid
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_name' => 'required|min:2|max:7',
        ]);

        $coupon = CouponShopCart::where('code_name', $request->code_name)->where(function($query) {
            $query->where('date_from','<=',Carbon::now())->where('date_to','>=',Carbon::now())
                ->orWhere(function($query2) {
                    $query2->whereNull('date_from')->orWhereNull('date_to');
                });
        })->first();

        if (isset($coupon)) {
            return apiResponseCoupon('api.code_name_exists', $coupon->discount_value);
        } else {
            return apiResponseCouponError('api.Coupon_Not_Exists');
        }

    }

    /**
     * Get all Order
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function OrdersTable(Request $request)
    {
        $app_user_id = auth('app_users_api')->user()->id;

        $orders = OrderTable::where('user_id', $app_user_id)
            ->whereIn('status_id',[1,2,3,4,5,6,7,8,9,10])
            ->with(['user', 'histories', 'subCategories', 'orderDetails', 'orderDetails.product', 'orderDetails.productService', 'orderDetails.categoryItem'])->latest()->get();

        $data = [];
        if (isset($orders)) {
            foreach ($orders as $order) {
                $data[] = self::orderObject($order);
            }
            /* weird code !!!!!
             * if ($order->status_id == 1 || $order->status_id == 2 || $order->status_id == 3 || $order->status_id == 4) {
                $count = OrderTable::where('user_id', $app_user_id)->count();
            } else {
                $count = 0;
                $orders->delete();
            }*/
            $new_order = collect($data)->where('status_id',self::WaitingForDelivery)->count();
            return apiResponseOrders('api.My_Order', $new_order, $data);
        } else {
            return apiResponseOrders('api.incorrect_data');
        }
    }

    /**
     * Update Order Status
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function UpdateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status_id' => 'required|in:2,3,4,5,6,7,8,9,10',
            //'status_id' => 'required_if:status_id,|in:2,3,4,5,6,7',
            'order_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toArray(), 422);
        }

        $app_user_id = auth('app_users_api')->user()->id;

        $order = OrderTable::
            whereIn('status_id',[1,2,3,4,5,6,7,8,9])
            ->where('id',$request->get('order_id'))
            ->with('user')
            ->first();

        if($order->user_id != $app_user_id && $order->delivery_id != $app_user_id){
            return apiResponseOrders('api.incorrect_data');
        }
        if($request->get('status_id') == self::Cancel && $order->status_id != self::WaitingForDelivery){
            return apiResponseOrders('api.order_no_allowed_canceled');
        }

        if (isset($order)) {
            $order->status_id = $request->get('status_id');
            $order->status    = getStatusName($request->get('status_id'));
            $order->save();

            $name = 'name_' . App::getLocale();
            NotificationController::sendNotification(
                getStatusName($request->get('status_id')),
                __('api.order_update',['laundry'=>$order->subCategories->$name,'status'=>getStatusName($request->get('status_id'))]),
                $order->user,
                $order->id);

            if($request->get('status_id') == self::Cancel){
                $users = AppUser::where([
                    'status' => 'active',
                    'user_type' => 'delivery',
                    'available'=>'0'
                ])->get();
                foreach ($users as $user) {
                    NotificationController::sendDataNotification(
                        $user,
                        $order->id);
                }
            }

            if($request->get('status_id') == self::WaitingForDeliveryToReceiveOrder) {
                $order->delivery_id = null;
                $order->save();

                $users = AppUser::where([
                    'status' => 'active',
                    'user_type' => 'delivery',
                    'available'=>'0'
                ])->get();
                foreach ($users as $user) {
                    NotificationController::sendNotification(
                        'New Delivery Request',
                        'New Delivery Request Number #' . $order->id,
                        $user,
                        $order->id);
                }
            }
            if($request->get("status_id") == self::Completed){
                $order->user->point++;
                $order->user->save();

                Transaction::create([
                    'app_user_id'   => auth('app_users_api')->user()->id,
                    'type'          => 'point',
                    'amount'        => ($order->user->point-1),
                    'current_amount'=> $order->user->point,
                    'direction'     => 'in'
                ]);
            }
            return apiResponseOrders('api.status_update',  $order);
        } else {
            return apiResponseOrders('api.incorrect_data');
        }
    }

    /**
     * Update Order Status
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateDeliveryType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'delivery_type' => 'required|in:1,2',
            'order_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toArray(), 422);
        }

        $app_user_id = auth('app_users_api')->user()->id;

        $order = OrderTable::where('user_id', $app_user_id)
            ->where('status_id',self::ClothesReadyForDelivery)
            ->where('id',$request->get('order_id'))
            ->with('user')
            ->first();

        if (isset($order)) {
            $status_id = $request->get('delivery_type') == 1? self::Completed : self::WaitingForDeliveryToReceiveOrder;
            $order->delivery_type = $request->get('delivery_type');
            $order->status_id = $status_id;
            $order->status    = getStatusName($status_id);
            if($request->get('delivery_type') == 2){
                $order->delivery_fees += $order->delivery_fees;
                $order->delivery_id = null;
            }
            $order->save();

            $name = 'name_' . App::getLocale();
            NotificationController::sendNotification(
                getStatusName($status_id),
                __('api.order_update',['laundry'=>$order->subCategories->$name,'status'=>getStatusName($status_id)]),
                $order->user,
                $order->id);
            if($request->get('delivery_type') == 2) {
                $users = AppUser::where([
                    'status' => 'active',
                    'user_type' => 'delivery',
                    'available'=>'0'
                ])->get();
                foreach ($users as $user) {
                    NotificationController::sendNotification(
                        'New Delivery Request',
                        'New Delivery Request Number #' . $order->id,
                        $user,
                        $order->id);
                }
            }
            return apiResponseOrders('api.status_update',  $order);
        } else {
            return apiResponseOrders('api.incorrect_data');
        }
    }

    /**
     * Update Order Status
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrder($id,Request $request)
    {

        $app_user_id = auth('app_users_api')->user()->id;

        $order = OrderTable::where('user_id', $app_user_id)
            ->where('id',$id)
            ->first();

        if (isset($order)) {
            $data = self::orderObject($order);
            return apiResponseOrders('api.status_update',  $data);
        } else {
            return apiResponseOrders('api.incorrect_data');
        }
    }

    /**
     * the order object
     * @return \Illuminate\Http\JsonResponse
     */

    public function getActiveOrder(){
        $order = OrderTable::where('user_id', auth('app_users_api')->user()->id)
            ->where('status_id', '<>',self::Completed)
            ->with(['user', 'histories', 'subCategories', 'orderDetails', 'orderDetails.product', 'orderDetails.productService', 'orderDetails.categoryItem'])->latest()->first();

        if (isset($order)) {
            $data = self::orderObject($order);
            return apiResponseOrders('api.My_Order', count($data), $data);
        } else {
            return apiResponseOrders('api.incorrect_data');
        }
    }

    public static function orderObject($order){
        $name = 'name_' . App::getLocale();
        $app_user = auth('app_users_api')->user();
        $status_histories = [];
        foreach($order->histories as $history){

            $status_histories[] = [

                'status_id' => $history->status_id,
                'status' => $history->status,
                'name' => getStatusName($history->status_id),
                'date' => $history->created_at->toDateString(),
                'time' => $history->created_at->format("h:i A"),
            ];
        }
        $order_details = [];
        foreach($order->orderDetails as $detail){
            $order_details[] = [
                'service_id' => $detail->productService->id ?? 0,
                'service_name' => $detail->productService->services ?? '',
                'product_name' => $detail->product->$name,
                'product_image' => $detail->product->image,
                'category_name' => $detail->categoryItem->$name ?? '',
                'count' => $detail->quantity,
                'price' => $detail->price,
            ];
        }
        $distance = getDistanceFirst1($app_user, $order->subCategories->lat, $order->subCategories->lng);
        $qrcode = "
Order #: {$order->id}
Laundry Name: {$order->subCategories->$name}
Customer Name: {$order->user->name}
";

        if(!file_exists(public_path('qrcodes/' . $order->id . '.svg'))) {
            QrCode::encoding('UTF-8')->errorCorrection('H')->size(100)->generate($qrcode, public_path('qrcodes/' . $order->id . '.svg'));
        }
        return [
            'laundry' => [
                'laundry_name' => $order->subCategories->$name,
                "laundry_id"=> $order->subCategories->id,
                "laundry_image"=> $order->subCategories->image,
                "laundry_lat"=> $order->subCategories->lat,
                "laundry_lng"=> $order->subCategories->lng,
                "laundry_address"=> $order->subCategories->address,
                'distance_class' =>  getDistanceClass($distance),
                'distance_class_id' =>  getDistanceClassId($distance),
                'rate' => $order->subCategories->rate_avg,
                "laundry_distance"=>  round($distance, 2),
            ],
            'address' => [
                "description" => $order->address->description ?? '',
                "city_id" => $order->address->city_id ?? '',
                "city" => $order->address->city->name ?? '',
                "region_name" => $order->address->region_name ?? '',
                "address" => $order->address->address ?? '',
                "building" => $order->address->building ?? '',
                'lat' => $order->address->lat ?? '',
                'lng' => $order->address->lng ?? '',
//                'image'=>'i.jpg',

                'image_url' => $order->address->image ? asset('assets/uploads/users_image/'.$order->address->image) : null,
            ],
            'user' => [
                //'me' => $app_user->id,
                "user_name" => $order->user->name,
                "user_image" => $order->user->image? asset('assets/uploads/users_avatar/'.$order->user->image) : null,
                "user_id" => $order->user->id,
                "user_mobile" => $order->user->mobile,
                "user_lat" => $order->user->lat,
                "user_lng" => $order->user->lng,
                "user_address" => $order->user->address,
                "user_building" => $order->user->building,
                "user_region_name" => $order->user->region_name,
                'address_description' => $order->user->address_description,
                'home_image' => $order->user->home_image? asset('assets/uploads/home_image/'.$order->user->home_image): null,
            ],
            'services' => $order_details,
            'order_id' => $order->id,
            'payment_method' => $order->payment_method,
            'qrcode' => asset('qrcodes/'.$order->id.'.svg'),
            'rate' => RateLaundry::select('rate')->where('order_id',$order->id)->first()['rate'] ?? null,
            'is_rated' => boolval(RateLaundry::where('order_id',$order->id)->count()),
            'delivery_type' => $order->delivery_type,
            'laundry name' => $order->subCategories->$name,
            'date' => $order->created_at->format("d M"),
            'status_id' => $order->status_id,
            'status' => getStatusName($order->status_id),
            'time' => $order->created_at->format("h:i A"),
            'quantity' => intval($order->count_products),
            'note' => $order->note ?? '',
            'coupon_value' => floatval($order->discount_value) ?? 0,
            //'total_price' => floatval($order->total_price),
            'delivery_fees' => floatval($order->delivery_fees),
            'discount' => floatval($order->discount),
            'vat' => floatval($order->vat),
            'sub_total' => floatval($order->total_price),
            'coupon_code' => $order->coupon,
            'audio_note' => $order->audio_note? asset('assets/uploads/audio_note/'.$order->audio_note) : null,
            'total_price_after_coupon' => $order->total_price - ($order->total_price * $order->discount_value),
            'total_price' => $order->total_price - $order->discount + $order->delivery_fees + $order->vat,
            'histories' => $status_histories,
            'status_list' => [
                '1'  => ($order->status_id>1)? 3: (($order->status_id==1)? 2 : 1),
                '2'  => ($order->status_id>2)? 3: (($order->status_id==2)? 2 : 1),
                '3'  => ($order->status_id>3)? 3: (($order->status_id==3)? 2 : 1),
                '4'  => ($order->status_id>4)? 3: (($order->status_id==4)? 2 : 1),
                '5'  => ($order->status_id>5)? 3: (($order->status_id==5)? 2 : 1),
                '6'  => ($order->status_id>6)? 3: (($order->status_id==6)? 2 : 1),
                '7'  => ($order->status_id>7)? 3: (($order->status_id==7)? 2 : 1),
                '8'  => ($order->status_id>8)? 3: (($order->status_id==8)? 2 : 1),
                '9'  => ($order->status_id>9)? 3: (($order->status_id==9)? 2 : 1),
                '10' => ($order->status_id>10)? 3: (($order->status_id==10)? 2 : 1),
            ]
        ];
    }

}
