<?php

namespace App\Http\Controllers\API;

use App\Models\Notifications;
use App\Models\OrderTable;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public static function sendNotification($title, $body, $user, $order_id=null,$is_admin = false,$saveInTable=true){

        $status_id = 0;
        if($order_id){
            $order = OrderTable::where('id',$order_id)->first();
            $status_id = $order->status_id;
        }

        $notification = [
            'title' => $title,
            'body' => $body,
            'icon'=> 'ic_launcher',
            'sound' => $status_id==1? 'new_order.wav' : 'general.wav',
            'android_channel_id' => $user->user_type == 'delivery'? 'delivery_channel' : 'user_channel',
            'badge' => 1,
        ];
        $extra = [
            'order_id' => $order_id,
            'status_id' => $status_id,
            'is_admin' => $is_admin,
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            'sound' => $status_id==1? 'new_order.wav' : 'general.wav',
            'android_channel_id' => $user->user_type == 'delivery'? 'delivery_channel' : 'user_channel',
            'priority' => 'high',
            'badge' => 1,
            'default_sound' => true,
        ];

        $fcmNotification = [
            'to' => $user->fcm_token,
            'notification' => $notification,
            'data' => $extra,
        ];

        $sent = false;
        try {
            // Create a client with a base URI
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'key=' . config("firebase.fcm_key"),
                ]
            ]);
            $response = $client->post('https://fcm.googleapis.com/fcm/send', [
                'body' => json_encode($fcmNotification),
                'verify' => false
            ]);
            $sent = true;
            Log::debug($response->getBody());
            Log::debug(json_encode($fcmNotification));
        }catch(\Exception $exception){
            Log::debug($exception->getMessage());
            //Log::error($exception->getTrace());
        }

        if ($saveInTable) {
            Notifications::create([
                'order_table_id' => $order_id,
                'seen' => 0,
                'app_user_id'=>auth('app_users_api')->user()->id,
                'content_en' => $body,
                'content_ar' => $body,
                'type' => $is_admin ? 'Admin' : 'System',
                'user_id' => $user->id,
                'title_ar' => $title,
                'title_en' => $title,
                'send' => $sent
            ]);
        }
        //echo $response->getBody();
        //debug($response->getBody(), $fcmNotification);

        Log::debug($fcmNotification);
    }

    public static function sendDataNotification($user, $order_id=null){
        $status_id = 0;
        if($order_id){
            $order = OrderTable::where('id',$order_id)->first();
            $status_id = $order->status_id;
        }
        $extra = [
            'order_id' => $order_id,
            'status_id' => $status_id,
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            'sound' => 'default',
            'priority' => 'high',
            'badge' => 1,
            'default_sound' => true,
        ];

        $fcmNotification = [
            'to' => $user->fcm_token,
            'data' => $extra,
        ];

        try {
            // Create a client with a base URI
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'key=' . config("firebase.fcm_key"),
                ]
            ]);
            $response = $client->post('https://fcm.googleapis.com/fcm/send', [
                'body' => json_encode($fcmNotification),
                'verify' => false
            ]);
            Log::debug($response->getBody());
            Log::debug(json_encode($fcmNotification));
        }catch(\Exception $exception){
            Log::debug($exception->getMessage());
            //Log::error($exception->getTrace());
        }

    }
}
