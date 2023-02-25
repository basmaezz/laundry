<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\DeliveryHistory;
use App\Models\DeliveryRejection;
use App\Models\OrderTable;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\ImageProduct;
use App\Models\Favorite;
use App\Models\Coupon;
use App\Models\Comment;
use App\Models\Cart;
use App\Models\Order;
use \Illuminate\Support\Facades\Validator;
use App\Models\User;
use DB;
use \Illuminate\Support\Facades\App;

class DelegatesController extends Controller
{
    public function delegate_orders(Request $request)
    {

        $app_user_id = auth('app_users_api')->user()->id;
        $orders = OrderTable::query();
        if($request->get('type') == 'unassigned'){
            $reject_order_ids = DeliveryRejection::where('user_id', $app_user_id)->get()->pluck('order_id');

            $orders = $orders->whereIn('status_id',[OrderController::WaitingForDelivery,OrderController::WaitingForDeliveryToReceiveOrder])->
            whereNull('delivery_id')->whereNotIn('id',$reject_order_ids->toArray());
        }
        if($request->get('type') == 'my_assigned'){
            $orders = $orders->whereIn('status_id',[
                OrderController::AcceptedByDelivery,
                OrderController::WayToLaundry,
                OrderController::AcceptedByDeliveryToYou,
            ])->where('delivery_id', $app_user_id);
        }
        $orders = $orders->latest()->get();
        $data = [];
        foreach ($orders as $order){
            $data[] = OrderController::orderObject($order);
        }
        dd($data);
        return apiResponseOrders('api.My_Order', count($data), $data);
    }

    public function delegate_order_details($order_id, Request $request)
    {
        $order = OrderTable::with('address')->where('id', $order_id)->first();
        return apiResponseOrders('api.My_Order', 1, OrderController::orderObject($order));
    }

    /**  public function delegate order status . */
    public function delegate_order_status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'action'   => 'nullable',
        ]);

        if ($validator->passes()) {

            $user  = JWTAuth::toUser();

            $order = Order::where(['id'=>$request->order_id,'delegate_id'=>$user->id])->first();

            if (!isset($order)){

                return responseJsonError ( trans('api.data_incorrect') );
            }

            if (isset($request->action) && $request->action == "delegate_delivered_laundry" ){

                $order->update(['status'=>$request->action]);
                $msg    = 'تم إيصال الطلب للمغسلة';
                $msg_en = 'The order has been delivered to the laundromat';
                FcmNotification($order->id,$msg,$msg_en,$order->user_id,'order');
            }

            if (isset($request->action) && $request->action == "delegate_received_laundry" ){

                $order->update(['status'=>$request->action]);
                $msg    = 'تم استلام الطلب من المغسلة';
                $msg_en = 'Order received from the laundromat';
                FcmNotification($order->id,$msg,$msg_en,$order->user_id,'order');
            }

            if (isset($request->action) && $request->action == "completed" ){

                $order->update(['status'=>$request->action]);
            }

            return responseJsonData($order->status);
        }

        return response()->json($validator->errors());
    }

    public function edit_product_service(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'order_id'   => 'required',
        ]);

        if ($validator->passes()) {

            $user  = JWTAuth::toUser();
            $name  = 'name_'.App::getLocale();
            $order = Order::where(['delegate_id'=>$user->id,'id'=>$request->order_id])->first();

            if (! isset($order) ){

                return responseJsonError(trans('api.data_incorrect'));
            }

            $data  = [];

           if (isset($request-> services)){

               $services = json_decode($request->services ,true);

               foreach ($services as $service){

                   $cart = Cart::where(['order_id'=> $order->id,'product_id' => $service['product_id'],
                       'service_id' => isset($service['service_id']) ? $service['service_id'] : null,
                   ])->update([

                      'price' => $service['price'],
                      'count' => $service['count'],
                   ]);
//                   $cart->save();
               }
           }

            $carts = Cart::whereIn('order_id',[$order->id])->where('product_id',$request->product_id)->get();

            foreach ($carts as $cart){
                $data [] = [
                    'id'         => $cart->id,
                    'service_id' => $cart->service_id,
                    'service'    => $cart->service->$name,
                    'price'      => $cart->price,
                    'count'      => $cart->count,
                ];
            }

            return responseJsonData($data);
        }

        return response()->json($validator->errors());
    }

    public function rejection_reason(){
        $reasons = config('setting.rejection_reason');
        return apiResponse('api.success', $reasons);
    }

    public function order_history(){
        $app_user_id = auth('app_users_api')->user()->id;
        $histories = DeliveryHistory::where('user_id',$app_user_id)->latest()->get();
        $data = [];
        foreach ($histories as $history){
            $order = OrderController::orderObject($history->order);
            if(//Display only completed delivery tasks
                ($history->order->status_id > OrderController::WayToLaundry && $history->direction == 'ToLaundry') ||
                ($history->order->status_id = OrderController::Completed && $history->direction == 'FromLaundry')
            ) {
                $order['direction'] = $history->direction;
                $data[] = $order;
            }
        }
        return apiResponseOrders('api.My_Order', count($data), $data);
    }

    public function accept_order(Request $request,$order_id){
        $app_user_id = auth('app_users_api')->user()->id;
//        $order = OrderTable::whereIn('status_id',[OrderController::WaitingForDelivery,OrderController::WaitingForDeliveryToReceiveOrder])
        $order = OrderTable::whereIn('status_id',[OrderController::WaitingForDelivery,OrderController::WaitingForDeliveryToReceiveOrder])
            ->where('id',$order_id)
            ->firstOrFail();
        $order->status_id = $order->status_id+1;
        $order->delivery_id = $app_user_id;
        $order->save();

        DeliveryHistory::create([
            'order_id'  => $order_id,
            'user_id'   => $app_user_id,
            'direction' => $order->status_id == OrderController::AcceptedByDelivery? 'ToLaundry' : 'FromLaundry'
        ]);

        $name = 'name_' . App::getLocale();
        NotificationController::sendNotification(
            getStatusName($order->status_id),
            __('api.order_update',['laundry'=>$order->subCategories->$name,'status'=>getStatusName($order->status_id)]),
            $order->user,
            $order->id);

        $users = AppUser::where([
            'status' => 'active',
            'user_type' => 'delivery',
        ])->get();

        foreach ($users as $user) {
            if($app_user_id == $user->id){
                continue;
            }
            NotificationController::sendDataNotification(
                $user,
                $order->id);
        }
        return apiResponse('api.success', $order);
    }

    public function reject_order(Request $request,$order_id){
        $validator = Validator::make($request->all(), [
            'reason_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toArray(), 422);
        }

        $app_user_id = auth('app_users_api')->user()->id;
        $order = OrderTable::whereIn('status_id',[OrderController::WaitingForDelivery,OrderController::WaitingForDeliveryToReceiveOrder])
            ->where('id',$order_id)
            ->firstOrFail();

        DeliveryRejection::create([
            'user_id'   => $app_user_id,
            'order_id'  => $order_id,
            'reason_id' => $request->get('reason_id'),
            'other'     => $request->get('other')
        ]);

        return apiResponse('api.success', $order);
    }

    public function delegate_has_order(Request $request){
        $app_user_id = auth('app_users_api')->user()->id;
        $histories = DeliveryHistory::where('user_id',$app_user_id)->limit(20)->latest()->get();
        $count = 0;
        foreach ($histories as $history){
            echo ($history->order->status_id);
            if(
                ($history->order->status_id == OrderController::AcceptedByDelivery && $history->direction == 'ToLaundry') ||
                ($history->order->status_id == OrderController::AcceptedByDeliveryToYou && $history->direction == 'FromLaundry')
            ) {
                $count ++;
            }
        }
        return response()->json(['count'=> $count]);
    }
}
