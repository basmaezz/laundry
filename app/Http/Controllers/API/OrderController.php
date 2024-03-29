<?php

namespace App\Http\Controllers\API;

use App\Models\AppUser;
use App\Models\carpetCategory;
use App\Models\carService;
use App\Models\CouponShopCart;
use App\Models\Delegate;
use App\Models\DeliveryHistory;
use App\Models\OrderDetails;
use App\Models\OrderTable;
use App\Models\Payment;
use App\Models\ProductService;
use App\Models\RateLaundry;
use App\Models\SiteSetting;
use App\Models\Subcategory;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
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
                'delivery_fees' => $laundry->price,
                'vat' => 0,
            ];
//                        if ($distance <= 10) {
//                            $data['delivery_fees'] = 10;
//                            $message = trans('api.Values_After_Calc_Vat_And_Fees');
//                        } elseif ($distance > 10 || $distance <= 20) {
//                            $data['delivery_fees'] = 20;
//                            $message = trans('api.Values_After_Calc_Vat_And_Fees');
//                        } else {
//                            $message = 'out of distance';
//                        }

            if ($distance != '') {
                $data['delivery_fees'] = $laundry->price;
                $message = trans('api.Values_After_Calc_Vat_And_Fees');
            }
//            return apiResponse($message, $data);
            return apiResponse2( $data);
        }
        return apiResponse(trans('api.error_validation'), $items = null, 500, 500);
    }
    /**
     * add new order
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addOrderTable(Request $request)
    {
        $app_user_id = auth('app_users_api')->user()->id;
        $orderData = json_decode($request->getContent(), true);
        $orderType=$orderData['order_type'];

        // $_totalOrders = OrderTable::where('user_id', $app_user_id)->where("status_id", '<', self::Completed)->count();
        // if ($_totalOrders >= intval(config('setting.max_order', 3))) {
        //     return apiResponseCouponError('api.You reached the maximum number or request', 400, 400);
        // }

        $discount_value = 0;
        if ($request->has('coupon') && !empty($request->get('coupon'))) {
            $coupon = CouponShopCart::where('code_name', $request->get('coupon'))->where(function ($query) {
                $query->where('date_from', '<=', Carbon::now())->where('date_to', '>=', Carbon::now())
                    ->orWhere(function ($query2) {
                        $query2->whereNull('date_from')->orWhereNull('date_to');
                    });
            })->first();
            if (isset($coupon)) {
                $discount_value = $coupon->discount_value;
            } else {
                return apiResponseCouponError('api.Coupon_Not_Exists');
            }
        }
        $laundry = Subcategory::where('id', $orderData['laundry_id'])->first();

        $distance = getDistanceFirst1(auth('app_users_api')->user(), $laundry->lat, $laundry->lng);
        if($orderType ==1){

            $order_data = [
                'user_id'        => $app_user_id,
                'laundry_id'     => $request->get('laundry_id'),
                'category_item_id' => $request->get('category_item_id'),
                'payment_method' => $request->get('payment_method', 'Cash'),
                'urgent'         => $request->get('urgent'),
                'address_id'     => $request->get('address_id'),
                'count_products' => count($orderData['items']),
                'order_type'=>$orderType,
                'note'           => $request->get('note'),
                'status'         => 'انتظار المندوب',
                'status_id'      => self::WaitingForDelivery,
                'total_price'    => 0,
                'discount_value' => $discount_value,
                'delivery_fees'  => $laundry->price,
                'discount'       => 0,
                'vat'            => 0,
                'commission'     => 0,
                'total_commission' => 0,
                'sum_price'      => 0,
                'laundry_profit'   =>0,
                'app_profit'       =>0,
                'coupon'         => $request->get('coupon') ?? null,
            ];

        }elseif ($orderType==3){
            $order_data = [
                'user_id'        => $app_user_id,
                'laundry_id'     =>  $orderData['laundry_id'],
                'address_id'     => $request->get('address_id'),
                'category_item_id' => $request->get('category_item_id'),
                'receive_time_id'=>$orderData['receive_time_id'],
                'receive_date'=>$orderData['receive_date'],
                'delivery_time_id'=>$orderData['delivery_time_id'],
                'delivery_date'=>$orderData['delivery_date'],
                'order_type'=>$orderType,
                'payment_method' => $request->get('payment_method', 'Cash'),
                'count_products' => count($orderData['items']),
                'note'           => $request->get('note'),
                'status'         => 'انتظار المندوب',
                'status_id'      => self::WaitingForDelivery,
                'total_price'    => 0,
                'delivery_fees'  => $laundry->price,
                'discount'       => 0,
                'vat'            => 0,
                'commission'     => 0,
                'total_commission' => 0,
                'sum_price'      => 0,
                'laundry_profit'   =>0,
                'app_profit'       =>0,
                'coupon'         => $request->get('coupon') ?? null,
            ];
        }elseif ($orderType==5){
            $order_data = [
                'user_id'        => $app_user_id,
                'laundry_id'     =>  $orderData['laundry_id'],
                'address_id'     => $request->get('address_id'),
                'car_service_id' => $request->get('car_service_id'),
                'order_type'=>$orderType,
                'payment_method' => $request->get('payment_method', 'Cash'),
                'count_products' => count($orderData['items']),
                'note'           => $request->get('note'),
                'status'         => 'انتظار المندوب',
                'status_id'      => self::WaitingForDelivery,
                'total_price'    => 0,
                'delivery_fees'  => 0,
                'discount'       => 0,
                'vat'            => 0,
                'commission'     => 0,
                'total_commission' => 0,
                'sum_price'      => 0,
                'laundry_profit'   =>0,
                'app_profit'       =>0,
                'coupon'         => $request->get('coupon') ?? null,
            ];
        }

        $order = OrderTable::create($order_data);

        if($orderType ==1) {
            $item_data = null;
            $sum_price = $total_commission = $commission = $total = $laundry_profit = $app_profit = 0;
            $item_quantity = 0;
            foreach ($request->get('items') as $key => $item) {
                $product = ProductService::where('id', $item['product_service_id'])->first();
                if ($product) {
                    $price = $request->get('urgent') == '1' ? $product->priceUrgent : $product->price;
                    $item_data = [
                        'order_table_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'category_item_id' => $item['category_id'],
                        'product_service_id' => $item['product_service_id'],
                        'quantity' => $item['quantity'],
                        'total_price' => $price * $item['quantity'],
                        'commission' => $product->commission,
                        'total_commission' => $product->commission * $item['quantity'],
                        'full_price' => ($price + $product->commission) * $item['quantity'],
                        'price' => $price,
                    ];
                    $commission += $product->commission;
                    $sum_price += $price * $item['quantity'];
                    $total_commission += $product->commission * $item['quantity'];
                    $laundry_profit = $sum_price - ($sum_price * $laundry->percentage) / 100;
                    $app_profit = ($sum_price * $laundry->percentage) / 100;
                    $total += ($price + $product->commission) * $item['quantity'];
                    $item_quantity += $item['quantity'];
                    OrderDetails::create($item_data);
                }
            }

            $order->sum_price = $sum_price;
            $order->commission = $commission;
            $order->total_commission = $total_commission;
            $order->total_price = $total + $laundry->price;
            $order->count_products = $item_quantity;
            $order->laundry_profit = $sum_price - ($sum_price * $laundry->percentage) / 100;
            $order->app_profit = ($sum_price * $laundry->percentage) / 100;
            $order->discount = floatval($total * $discount_value);
            $order->vat = floatval($total * config('setting.vat'));
            if ($request->hasFile('audio_note')) {
                $order->audio_note = uploadFile($request->file("audio_note"), 'audio_note');
            }
            $order->save();
        }elseif ($orderType==3){
            $item_data = null;
            $total= $app_profit = 0;
            $item_quantity = 0;
            foreach ($orderData['items'] as $key => $item) {

                $carpetCategory = carpetCategory::where('id', $item['carpet_category_id'])->first();
                if ($carpetCategory) {

                    $item_quantity += $item['quantity'];
                    $OrderDetail=new OrderDetails;
                    $OrderDetail->order_table_id=$order->id;
                    $OrderDetail->carpet_category_id=$item['carpet_category_id'];
                    $OrderDetail->quantity=$item['quantity'];
                    $OrderDetail->price=$carpetCategory->price;
                    $OrderDetail->total_price=$carpetCategory->price*$item['quantity'];
                    $OrderDetail->full_price=$laundry->price+($carpetCategory->price * $item['quantity']);
                    $OrderDetail->laundry_profit=$carpetCategory->laundry_profit * $item['quantity'];
                    $OrderDetail->app_profit=$carpetCategory->price * $item['quantity'] -$carpetCategory->laundry_profit * $item['quantity'];

                    $OrderDetail->save();

                }
            }
            $order->total_price = ($carpetCategory->price*$item_quantity) + $laundry->price;
            $order->count_products = $item_quantity;
            $order->app_profit=$app_profit;
            $order->laundry_profit=$carpetCategory->laundry_profit*$item_quantity;
            $order->vat = floatval($total * config('setting.vat'));
            if ($request->hasFile('audio_note')) {
                $order->audio_note = uploadFile($request->file("audio_note"), 'audio_note');
            }
            $order->save();

        }elseif ($orderType==5){
            $item_data = null;
            $total= $app_profit = 0;
            $item_quantity = 0;
            foreach ($orderData['items'] as $key => $item) {

                $carService = carService::where('id', $item['car_service_id'])->first();
                if ($carService) {

                    $item_quantity += $item['quantity'];
                    $OrderDetail=new OrderDetails;
                    $OrderDetail->order_table_id=$order->id;
                    $OrderDetail->car_service_id=$item['car_service_id'];
                    $OrderDetail->quantity=$item['quantity'];
                    $OrderDetail->price=$carService->price;
                    $OrderDetail->total_price=$carService->price*$item['quantity'];
                    $OrderDetail->full_price=$carService->price*$item['quantity'];
                    $OrderDetail->laundry_profit=0;
                    $OrderDetail->app_profit=0;

                    $OrderDetail->save();

                }
            }
            $order->total_price = $carService->price*$item_quantity;
            $order->count_products = $item_quantity;
            $order->app_profit=$app_profit;
            $order->laundry_profit=($carService->price*$item_quantity);
            $order->vat = floatval($total * config('setting.vat'));
            if ($request->hasFile('audio_note')) {
                $order->audio_note = uploadFile($request->file("audio_note"), 'audio_note');
            }
            $order->save();

        }
        //Start Store Payment information
        foreach ($orderData['payments'] as $payment) {
            Payment::create([
                'user_id'           => $app_user_id,
                'order_id'          => $order->id,
                'transaction_id'    => $payment['id'] ?? null,
                'status'            => $payment['status'] ?? 'Unknown',
                'payload'           => $payment['payload'] ?? null
            ]);
        }
        //End Store Payment information
        if($order->order_type==3){
            $orders = OrderTable::where('id', $order->id)->with(['orderDetails' => function ($q) {
                return $q->select('id', 'order_table_id', 'carpet_category_id', 'price', 'quantity');
            }])->select('id', 'user_id', 'laundry_id')->first();
        }elseif ($order->order_type==5){
            $orders = OrderTable::where('id', $order->id)->with(['orderDetails' => function ($q) {
                return $q->select('id', 'order_table_id', 'car_service_id', 'price', 'quantity');
            }])->select('id', 'user_id', 'laundry_id')->first();
        }
        else{
            $orders = OrderTable::where('id', $order->id)->with(['orderDetails' => function ($q) {
                return $q->select('id', 'order_table_id', 'product_id', 'category_item_id', 'price', 'quantity');
            }])->select('id', 'user_id', 'laundry_id')->first();
        }


        $name = 'name_' . App::getLocale();
        $msg="";
        if($order->order_type ==3){
            $msg='جهّز سجادك، مندوبنا جايك! 💨🏎️';

        }elseif($order->order_type ==1){
            $msg='جهّز ملابسك في كيس، مندوبنا جايك! 💨🏎️';
        }elseif($order->order_type ==5){
            $msg=' مندوبنا جايك! 💨🏎️';
        }
        NotificationController::sendNotification(__('api.received_successfully'), $msg, auth('app_users_api')->user(), $order->id);

        $customer = auth('app_users_api')->user();

        $settings = SiteSetting::first();
        $distanceDelegate = $settings->distance_delegates ?? config('setting.distance.in_area');

        if($orderType==1){
            $delegates = AppUser::where([
                'status' => 'active',
                'user_type' => 'delivery',
                'available' => '1',
            ])->whereRaw('( 6371 * acos( cos( radians(' . $customer->lat . ') ) * cos( radians( lat ) )
           * cos( radians( lng ) - radians(' . $customer->lng . ') ) + sin( radians(' . $customer->lat . ') )
           * sin( radians( lat ) ) ) ) <= ' . $distanceDelegate)->get();

            if (count($delegates) == 0) {
                $delegates = AppUser::where([
                    'status' => 'active',
                    'user_type' => 'delivery',
                    'available' => '1',
                ])->get();
            }
            foreach ($delegates as $user) {
                NotificationController::sendNotification(
                    'New Delivery Request',
                    'New Delivery Request Number #' . $order->id,
                    $user,
                    $order->id
                );
            }
        }elseif ($orderType == 3){

            $raw = "( 6371 * acos( cos( radians({$customer->lat}) ) * cos( radians( lat ) )* cos( radians( lng ) - radians({$customer->lng}) )
            + sin( radians({$customer->lat}) ) * sin( radians( lat ) ) ) ) <= {$distanceDelegate}";
            $carpetDelegates  = AppUser::query()
                ->available()
                ->delivery()
                ->active()
                ->whereHas('delegates', function ($query) {
                    $query->where('deliver_carpet', 1);
                })
                ->whereRaw($raw)
                ->get();

            if(count($carpetDelegates) == 0) {
                $carpetDelegates  = AppUser::query()
                    ->available()
                    ->delivery()
                    ->active()
                    ->whereHas('delegates', function ($query) {
                        $query->where('deliver_carpet', 1);
                    })
                    ->get();
            }

            foreach ($carpetDelegates as $user) {
                NotificationController::sendNotification(
                    'New Delivery Request',
                    'New Delivery Request Number #' . $order->id,
                    $user,
                    $order->id
                );
            }
        }elseif ($orderType == 5){

            $raw = "( 6371 * acos( cos( radians({$customer->lat}) ) * cos( radians( lat ) )* cos( radians( lng ) - radians({$customer->lng}) )
            + sin( radians({$customer->lat}) ) * sin( radians( lat ) ) ) ) <= {$distanceDelegate}";
            $carpetDelegates  = AppUser::query()
                ->available()
                ->delivery()
                ->active()
                ->whereHas('delegates', function ($query) {
                    $query->where('car_wash', 1);
                })
                ->whereRaw($raw)
                ->get();

            if(count($carpetDelegates) == 0) {
                $carpetDelegates  = AppUser::query()
                    ->available()
                    ->delivery()
                    ->active()
                    ->whereHas('delegates', function ($query) {
                        $query->where('car_wash', 1);
                    })
                    ->get();
            }

            foreach ($carpetDelegates as $user) {
                NotificationController::sendNotification(
                    'New Delivery Request',
                    'New Delivery Request Number #' . $order->id,
                    $user,
                    $order->id
                );
            }
        }

        return apiResponseOrders1('api.received_successfully', $orders);
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

        $coupon = CouponShopCart::where('code_name', $request->code_name)->where(function ($query) {
            $query->where('date_from', '<=', Carbon::now())->where('date_to', '>=', Carbon::now())
                ->orWhere(function ($query2) {
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
            ->whereIn('status_id', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10])
            ->with(['userTrashed', 'histories', 'subCategoriesTrashed', 'orderDetails', 'orderDetails.productTrashed', 'orderDetails.productService', 'orderDetails.categoryItem'])->latest()->get();


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
            $new_order = collect($data)->where('status_id', self::WaitingForDelivery)->count();
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

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        $app_user_id = auth('app_users_api')->user()->id;


        $order = OrderTable::whereIn('status_id', [1, 2, 3, 4, 5, 6, 7, 8, 9])
            ->where('id', $request->get('order_id'))
            ->with(['userTrashed', 'subCategoriesTrashed'])
            ->first();


        if ($order->user_id != $app_user_id && $order->delivery_id != $app_user_id) {
            return apiResponseOrders('api.incorrect_data');
        }
        if ($request->get('status_id') == self::Cancel && $order->status_id != self::WaitingForDelivery) {
            return apiResponseOrders('api.order_no_allowed_canceled');
        }


        if (isset($order)) {
            $order->status_id = $request->get('status_id');
            $order->status    = getStatusName($request->get('status_id'));
            $order->save();


            if($order->order_type == 1){
                $notification_obj = getNotificationObj($request->get('status_id'));
                NotificationController::sendNotification(
                    $notification_obj['title'],
                    $notification_obj['description'],
                    $order->userTrashed,
                    $order->id
                );
            }elseif($order->order_type==3 && in_array($request->get('status_id'), [1, 4, 8])){
                $notification_carpet_obj = getCarpetNotificationObj($request->get('status_id'));
                NotificationController::sendNotification(
                    $notification_carpet_obj['title'],
                    $notification_carpet_obj['description'],
                    $order->userTrashed,
                    $order->id
                );
            }elseif($order->order_type==3 && in_array($request->get('status_id'), [1, 2, 8])){
                $notification_car_obj = getCarNotificationObj($request->get('status_id'));
                NotificationController::sendNotification(
                    $notification_car_obj['title'],
                    $notification_car_obj['description'],
                    $order->userTrashed,
                    $order->id
                );
            }


            if ($request->get('status_id') == self::Cancel) {
                $users = AppUser::where([
                    'status' => 'active',
                    'user_type' => 'delivery',
                    'available' => '0'
                ])->get();
                foreach ($users as $user) {
                    NotificationController::sendDataNotification(
                        $user,
                        $order->id
                    );
                }
            }


            if ($request->get('status_id') == self::WaitingForDeliveryToReceiveOrder) {
                $order->delivery_id = null;
                $order->save();

                $settings = SiteSetting::first();
                $distanceDelegate = $settings->distance_delegates ?? config('setting.distance.in_area');

                $delegates = AppUser::where([
                    'status' => 'active',
                    'user_type' => 'delivery',
                    'available' => '1',
                ])->whereRaw('( 6371 * acos( cos( radians(' . $order->subCategoriesTrashed->lat . ') ) * cos( radians( lat ) )
                   * cos( radians( lng ) - radians(' . $order->subCategoriesTrashed->lng . ') ) + sin( radians(' . $order->subCategoriesTrashed->lat . ') )
                   * sin( radians( lat ) ) ) ) <= ' . $distanceDelegate)->get();
                if (count($delegates) == 0) {
                    $delegates = AppUser::where([
                        'status' => 'active',
                        'user_type' => 'delivery',
                        'available' => '1'
                    ])->get();
                }
                foreach ($delegates as $user) {
                    NotificationController::sendNotification(
                        'New Delivery Request',
                        'New Delivery Request from laundry, Order Number #' . $order->id,
                        $user,
                        $order->id
                    );
                }
            }
            if ($request->get("status_id") == self::Completed) {
                $order->userTrashed->point++;
                $order->userTrashed->save();

                if($order->status_id = self::DeliveredToLaundry )
                {
                    if($order->delegateTrashed->request_employment=='1')
                    {
                        $order->delegateTrashed->appUserTrashed->wallet+=floatval($order->subCategoriesTrashed->price);
                    }
                }
                if($order->status_id = self::Completed)
                {
                    if($order->delegateTrashed->request_employment=='1')
                    {
                        $order->delegateTrashed->appUserTrashed->wallet+=floatval($order->subCategoriesTrashed->price);
                    }
                }
                Transaction::create([
                    'app_user_id'   => auth('app_users_api')->user()->id,
                    'type'          => 'point',
                    'amount'        => ($order->userTrashed->point - 1),
                    'current_amount' => $order->userTrashed->point,
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

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        $app_user_id = auth('app_users_api')->user()->id;
        $order = OrderTable::with('userTrashed')->where('user_id', $app_user_id)
            ->where('status_id', self::ClothesReadyForDelivery)
            ->where('id', $request->get('order_id'))
            ->first();

        if (isset($order)) {
            $status_id = $request->get('delivery_type') == 1 ? self::Completed : self::WaitingForDeliveryToReceiveOrder;
            $order->delivery_type = $request->get('delivery_type');
            $order->status_id = $status_id;
            $order->status    = getStatusName($status_id);
            if ($request->get('delivery_type') == 2) {
                $order->delivery_fees += $order->delivery_fees;
                $order->delivery_id = null;
            }
            $order->save();
            //Start Store Payment information
            foreach ($request->get('payments') as $payment){
                Payment::create([
                    'user_id'           => $app_user_id,
                    'order_id'          => $order->id,
                    'transaction_id'    => $payment['id'] ?? null,
                    'status'            => $payment['status'] ?? 'Unknown',
                    'payload'           => $payment['payload'] ?? null
                ]);
            }
            //End Store Payment information

            $notification_obj = getNotificationObj($status_id);
            NotificationController::sendNotification(
                $notification_obj['title'],
                $notification_obj['description'],
                $order->userTrashed,
                $order->id
            );

            if ($request->get('delivery_type') == 2) {
                $settings = SiteSetting::first();
                $distanceDelegate = $settings->distance_delegates ?? config('setting.distance.in_area');

                $delegates = AppUser::where([
                    'status' => 'active',
                    'user_type' => 'delivery',
                    'available' => '1',
                ])->whereRaw('( 6371 * acos( cos( radians(' . $order->subCategoriesTrashed->lat . ') ) * cos( radians( lat ) )
                   * cos( radians( lng ) - radians(' . $order->subCategoriesTrashed->lng . ') ) + sin( radians(' . $order->subCategoriesTrashed->lat . ') )
                   * sin( radians( lat ) ) ) ) <= ' . $distanceDelegate)->get();
                if (count($delegates) == 0) {
                    $delegates = AppUser::where([
                        'status' => 'active',
                        'user_type' => 'delivery',
                        'available' => '1'
                    ])->get();
                }

                //dd($users);
                foreach ($delegates as $user) {
                    NotificationController::sendNotification(
                        'New Delivery Request',
                        'New Delivery Request from laundry, Order Number #' . $order->id,
                        $user,
                        $order->id
                    );
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
    public function getOrder($id, Request $request)
    {

        $app_user_id = auth('app_users_api')->user()->id;

        $order = OrderTable::where('user_id', $app_user_id)
            ->where('id', $id)
            ->with('carpetLaundryReceiveTime','carpetLaundryDeliveryTime')
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

    public function getActiveOrder()
    {
        $order = OrderTable::where('user_id', auth('app_users_api')->user()->id)
            ->where('status_id', '<>', self::Completed)
            ->with(['user', 'histories', 'subCategoriesTrashed', 'orderDetails', 'orderDetails.productTrashed', 'orderDetails.productService', 'orderDetails.categoryItem'])->latest()->first();

        if (isset($order)) {
            $data = self::orderObject($order);
            return apiResponseOrders('api.My_Order', count($data), $data);
        } else {
            return apiResponseOrders('api.incorrect_data');
        }
    }

    public static function orderObject($order)
    {

        $name = 'name_' . App::getLocale();
        $app_user = auth('app_users_api')->user();
        $status_histories = [];
//dd($order->histories);
        foreach ($order->histories as $history) {

            $status_histories[] = [
                'status_id' => $history->status_id,
                'spend_time' => $history->spend_time,
                'status' => $history->status,
                'name' => getStatusName($history->status_id),
                'date' => $history->created_at->toDateString(),
                'time' => $history->created_at->format("h:i A"),
            ];
        }

        $order_details = [];
        if($order->order_type==3){
            foreach ($order->orderDetails as $detail) {
                $categoryName = 'category_' . App::getLocale();
                $order_details[] = [
                    'category_name' => $detail->carpetCategoryTrashed->$categoryName??'',
                    'count' => $detail->quantity,
                    'price' => $detail->full_price,
                ];
            }

        }elseif ($order->order_type==5){
            foreach ($order->orderDetails as $detail) {
                $carService = 'name_' . App::getLocale();
                $order_details[] = [
                    'category_name' => $detail->carService->$carService??'',
                    'count' => $detail->quantity,
                    'price' => $detail->full_price,
                ];
            }

        }else{
            foreach ($order->orderDetails as $detail) {
                $order_details[] = [
                    'service_id' => $detail->productService->id ?? 0,
                    'service_name' => $detail->productService->services ?? '',
                    'product_name' => $detail->productTrashed->$name??'',
                    'product_image' => $detail->productTrashed->image??'',
                    'category_name' => $detail->categoryItem->$name ?? '',
                    'urgent'=>$detail->urgent=='1'?'urgent':'normal',
                    'count' => $detail->quantity,
                    'price' => $detail->full_price,
                ];
            }
        }

        $distance = getDistanceFirst1($app_user, $order->subCategoriesTrashed->lat, $order->subCategoriesTrashed->lng);
        $range = $order->subCategoriesTrashed->range;
        $qrcode = " Order #: {$order->id}
                    Laundry Name: {$order->subCategoriesTrashed->$name}
                    Customer Name: {$order->userTrashed->name} ";

        if (!file_exists(public_path('qrcodes/' . $order->id . '.svg'))) {
            QrCode::encoding('UTF-8')->errorCorrection('H')->size(100)->generate($qrcode, public_path('qrcodes/' . $order->id . '.svg'));
        }
        //   dd($order->carpetLaundryReceiveTime->end_to);
        $receieveTimeFrom=$order->carpetLaundryReceiveTime->start_from ??'' ;
        $receieveTimeTo=$order->carpetLaundryReceiveTime->end_to ??'' ;

        $deliverTimeFrom=$order->carpetLaundryDeliveryTime->start_from ??'' ;
        $deliverTimeTo= $order->carpetLaundryDeliveryTime->end_to ??'';
        return [

            'laundry' => [
                'laundry_name' => $order->subCategoriesTrashed->$name,
                "laundry_id" => $order->subCategoriesTrashed->id,
                "laundry_image" => $order->subCategoriesTrashed->image,
                "laundry_lat" => $order->subCategoriesTrashed->lat,
                "laundry_lng" => $order->subCategoriesTrashed->lng,
                "laundry_delivered_from" => $order->subCategoriesTrashed->delivered_from,
                "laundry_delivered_to" => $order->subCategoriesTrashed->delivered_to,
                "laundry_address" => $order->subCategoriesTrashed->address,
                'laundry_range' => $order->subCategoriesTrashed->range,
                'distance_class' =>  getDistanceClass($distance, $range),
                'distance_class_id' =>  getDistanceClassId($distance, $range),
                'rate' => $order->subCategoriesTrashed->rate_avg,
                "laundry_distance" =>  round($distance, 2),
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
                'image_url' => $order->address->image ? asset('assets/uploads/users_image/' . $order->address->image) : null,
            ],
            'user' => [
                //'me' => $app_user->id,
                "user_name" => $order->userTrashed->name,
                "user_image" => $order->userTrashed->image ? asset('assets/uploads/users_avatar/' . $order->userTrashed->image) : null,
                "user_id" => $order->userTrashed->id,
                "user_mobile" => $order->userTrashed->mobile,
                "user_lat" => $order->userTrashed->lat,
                "user_lng" => $order->userTrashed->lng,
                "user_address" => $order->userTrashed->address,
                "user_building" => $order->userTrashed->building,
                "user_region_name" => $order->userTrashed->region_name,
                'address_description' => $order->userTrashed->address_description,
                'home_image' => $order->userTrashed->home_image ? asset('assets/uploads/home_image/' . $order->userTrashed->home_image) : null,
            ],



            'services' => $order_details,
            'order_id' => $order->id,
            'order_type' => $order->order_type,
            'receive_time'=>$order->order_type ==3 ? $receieveTimeFrom. '-' . $receieveTimeTo :null,
            'receive_date'=>$order->receive_date ??null,
            'delivery_time'=>$order->order_type ==3 ?  $deliverTimeFrom .'-' . $deliverTimeTo :null,
            'delivery_date'=>$order->delivery_date ??null,
            'payment_method' => $order->payment_method,
            'qrcode' => asset('qrcodes/' . $order->id . '.svg'),
            'rate' => RateLaundry::select('rate')->where('order_id', $order->id)->first()['rate'] ?? null,
            'is_rated' => boolval(RateLaundry::where('order_id', $order->id)->count()),
            'delivery_type' => $order->delivery_type,
            'laundry name' => $order->subCategoriesTrashed->$name,
            'date' => $order->created_at->format("d M"),
            'status_id' => $order->status_id,
            'urgent'=>$order->urgent ?'urgent':'normal',
            'status' => getStatusName($order->status_id),
            'time' => $order->created_at->format("h:i A"),
            'quantity' => intval($order->count_products),
            'note' => $order->note ?? '',
            'coupon_value' => floatval($order->discount_value) ?? 0,
            'delivery_fees' => $order->subCategoriesTrashed->price,
            'discount' => floatval($order->discount),
            'vat' => floatval($order->vat),
            'sub_total' => floatval($order->total_price) + floatval($order->total_commission),
            'coupon_code' => $order->coupon,
            'audio_note' => $order->audio_note ? asset('assets/uploads/audio_note/' . $order->audio_note) : null,
            'total_price_after_coupon' => floatval($order->total_price) - floatval($order->discount),
            'total_price' => floatval($order->total_price), // - $order->discount + $order->delivery_fees + $order->vat,// + $order->commission,//Removed due to already calculated at placing order
            'histories' => $status_histories,
            'status_list' => [
                '1'  => ($order->status_id > 1) ? 3 : (($order->status_id == 1) ? 2 : 1),
                '2'  => ($order->status_id > 2) ? 3 : (($order->status_id == 2) ? 2 : 1),
                '3'  => ($order->status_id > 3) ? 3 : (($order->status_id == 3) ? 2 : 1),
                '4'  => ($order->status_id > 4) ? 3 : (($order->status_id == 4) ? 2 : 1),
                '5'  => ($order->status_id > 5) ? 3 : (($order->status_id == 5) ? 2 : 1),
                '6'  => ($order->status_id > 6) ? 3 : (($order->status_id == 6) ? 2 : 1),
                '7'  => ($order->status_id > 7) ? 3 : (($order->status_id == 7) ? 2 : 1),
                '8'  => ($order->status_id > 8) ? 3 : (($order->status_id == 8) ? 2 : 1),
                '9'  => ($order->status_id > 9) ? 3 : (($order->status_id == 9) ? 2 : 1),
                '10' => ($order->status_id > 10) ? 3 : (($order->status_id == 10) ? 2 : 1),
            ],

        ];
    }
}
