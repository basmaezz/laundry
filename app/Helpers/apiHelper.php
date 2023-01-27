<?php

use App\Models\ProductService;
use App\Models\ProductImage;
use App\Models\Notifications;
use App\Models\ProviderExtra;
use App\Models\SiteSetting;
use App\Models\Favorite;
use App\Models\Service;
use App\Models\Product;
use App\Models\Device;
use App\Models\Extra;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Rate;
use Carbon\Carbon;
use App\Models\User;


/**  public function user Info  . */
function userInfo($userId , $lang ='ar' , $mac_address = null){

    $user       = User::find($userId);
    $name       = 'name_' .$lang;
    $device     = get_mac_address($user , $mac_address);

    $data = [
        'name'           => $user->name,
        'last_name'      => isset($user->last_name) ? $user->last_name : '',
        'phone'          => $user->phone,
        'email'          => isset($user->email)   ? $user->email       : '',
        'lat'            => isset($user->lat)     ? $user->lat         : '',
        'lng'            => isset($user->lng)     ? $user->lng         : '',
        'address'        => isset($user->address) ? $user->address     : '',
        'city_id'        => isset($user->city_id) ? $user->city_id     : 0,
        'city_name'      => isset($user->city_id) ? $user->city->$name : '',
        'mac_address_id' => isset($mac_address)   ? $mac_address       : '',
        'code'           => $user->code,
        'user_type'      => $user->user_type,
        'device_id'      => isset($device->device_id) ? $device->device_id : '',
        'device_type'    => isset($device->device_type) ? $device->device_type : '',
        'avatar'         => assetsUpload().'/users_avatar/' .$user->avatar,
        'date'           => date_format(date_create($user->created_at), 'Y-m-d'),
        'token'          => $user->jwt_token,
    ];

    return $data;
}

/**  public function user Data  . */
function userData($userId){

    $user   = User::find($userId);
    $device = Device::where('user_id',$user->id)->latest('id')->first();

    $data = [
        'id'                  => $user->id,
        'name'                => $user->name,
        'phone'               => $user->phone,
        'email'               => $user->email,
        'code_number'         => $user->phone,
        'code'                => $user->code,
        'user_type'           => $user->user_type,
        'provider_type'       => isset($user->provider_type) ? $user->provider_type : '',
        'device_id'           => isset($device->device_id) ? $device->device_id : '',
        'device_type'         => isset($device->device_type) ? $device->device_type : '',
        'avatar'              => assetsUpload().'/users_avatar/' .$user->avatar,
        'date'                => date_format(date_create($user->created_at), 'Y-m-d'),
    ];
    return $data;
}

function get_mac_address($user , $mac_address){

    if (isset($mac_address)){

        $device = Device::where(['user_id'=>$user->id,'mac_address_id'=>$mac_address])->latest('id')->first();

    }else{

        $device = Device::where(['user_id'=>$user->id])->latest('id')->first();
    }

    return $device;
}

/**  public function commission . */
function commission ($providerId){

    $commission = SiteSetting::first()->commission;

    User::where('id',$providerId)->increment('arrears', $commission);
}

/**  public function user Notification . */
function userNotification($user_id){

    $user   = User::find($user_id);

    return (int) $user->notification;
}

/**  public function Fcm Notification . */
function FcmNotification($order_id , $msg , $msg_en , $user_id , $type = 'notification'){

    $status = ['order','new_order','finished'];

    Notifications::create([
        'user_id'         => $user_id,
        'order_id'        => in_array($type, $status) ? $order_id : null,
        'type'            => $type,
        'content_ar'      => $msg,
        'content_en'      => $msg_en,
    ]);

    // FCM
    $title   = $msg;
    $data    = ['type'=> $type ,'body'=>$title];
    $devices = Device::where('user_id',$user_id)->get();

    foreach ($devices as $device){

        $userNotification = userNotification($device->user_id);

        SendFcm($device->device_id ,$data ,$title,$device->device_type , $userNotification);
    }
}

/**  public function product images . */
function product_images($product , $type = 'image'){

    if ($type == 'images'){

        $data = ProductImage::where('product_id',$product)->select('id','image')->get();

    }else{

        $data = ProductImage::where('product_id',$product)->first()->image;
    }

    return $data;
}

/**  public function product services . */
function product_services($product , $branche , $type = 'service' , $mac_address = null){

    $branche_price = ProductService::where(['product_id'=>$product])->first();

    $services      = $branche_price->services;
    $name          = 'name_'.App::getLocale();
    $data          = [];


    foreach (json_decode($services) as $service){

        if ($type == 'price'){

            $data = $service->price;

        }else{

            $item = Service::find($service->service_id);
            $cart = check_in_cart($product,$mac_address,0, $item->id);
            $data [] = [
                'id'     => $item->id,
                'price'  => $service->price,
                'count'  => isset($cart) ? (int) $cart->count :  0 ,
                'name'   => $item->$name,
            ];
        }
    }

    return $data;
}

/**  public function product services price . */
function product_services_price($product , $branche ,$type = 'service', $serviceId=null){

    $branche_price = ProductService::where(['product_id'=>$product,'branche_id'=> $branche['id']])->first();
    $services      = $branche_price->services;
    $data          = [];

    foreach (json_decode($services) as $service){

        if ($type == 'price'){

            $data = $service->price;

        }else{

            $item = Service::find($service->service_id);
            if ( $serviceId == $item->id){
                $data [] = [
                    'id'     => $item->id,
                    'price'  => $service->price,
                ];
            }
        }
    }

    return $type == 'service' ?  $data[0]['price'] : $data ;
}

/**  public function is favorite. */
function is_favorite($provider){

    $JwtToken = JWTAuth::getToken();

    if (isset($JwtToken)){

        $JwtUser  = JWTAuth::toUser();

        $favorite = Favorite::where(['user_id'=>$JwtUser->id , 'provider_id'=>$provider])->first();
        $data     = isset($favorite) ? 1 : 0;

    }else{

        $data     =  0;
    }

    return $data ;
}

/**  public function get products */
function get_products($products , $branche , $category = null,$mac_address = null,$provider = null){

    $data          = [];
    $name          = 'name_'. App::getLocale();
    $desc          = 'desc_'. App::getLocale();

    foreach ($products as $product){

        $check_type = isset($category) ? $category->type : $product->category->type;

        $data [] = [
            'id'          => $product->id,
            'provider_id' => $product->user_id,
            'name'        => $product->$name,
            'favorite'    => 0,
            'category'    => $product->category->type,
            'category_id' => $product->category_id,
            'in_cart'     => isset($mac_address) ?  check_in_cart($product->id , $mac_address ,1,null,$provider) : 0,
            'image'       => product_images($product->id,'image'),
            'desc'        => isset($product->$desc)    ? $product->$desc : '',
            'services'    => $check_type == 'category' ? product_services($product->id,1) : [],
        ];
    }

    return $data;
}

/**  public function check in cart */
function check_in_cart($product , $mac_address , $check = 1 , $service = null,$provider =null){

  $orders  = Order::where(['status'=>'cart','mac_address_id'=>$mac_address,'provider_id'=>$provider])->pluck('id')->toArray();

  $carts   = Cart::whereIn('order_id',$orders)->where('product_id',$product)->get();

  if ($check == 1 ){

      $cart    = ! $carts->isEmpty() ?  1 : 0  ;

  }else{

      $data_service = Cart::whereIn('order_id',$orders)->where(['product_id'=>$product,'service_id'=>$service])->first();

      $cart    = isset($data_service) ?  $data_service : null;
  }

  return   $cart;
}

/**  public function carts */
function carts ($order){

    $carts  = Cart::where('order_id',$order->id)->get();
    $name   = 'name_'. App::getLocale();
    $data   = [] ;

    foreach ($carts->unique('product_id') as $cart){

        $services      = Cart::where(['order_id'=>$order->id,'product_id'=>$cart->product_id])->get();
        $data_services = [];

        foreach ($services as $service){

            $data_services [] = [
                'id'     => $service->id,
                'name'   => isset($cart->service_id) ? $service->service->$name : '',
                'price'  => $service->count * $service->price,
                'count'  => $service->count,
            ];
        }

        $data  []  = [
            'image'      => product_images($cart->product_id,'image'),
            'name'       => $cart->product->$name,
            'product_id' => $cart->product_id,
            'services'   => $data_services
        ];
    }

    return  $data;
}

/**  public function total cart */
function total_cart($mac_address , $category = null , $provider = null){

    $data = ['status'=>'cart','mac_address_id'=>$mac_address,'provider_id'=>$provider];

    if (isset($category)){

        $orders = Order::where($data)->where('category_id',$category)->pluck('id')->toArray();
    }else{

        $orders = Order::where($data)->pluck('id')->toArray();
    }

    $carts  = Cart::whereIn('order_id',$orders)->get();

//  $count   = Cart::whereIn('order_id',$orders)->distinct()->count('product_id');
    $count   = Cart::whereIn('order_id',$orders)->sum('count');

    $total   = 0;

    foreach ($carts as $_cart){

        $total +=  $_cart->count * $_cart->price;
    }

    $cart['pieces']    = $count;
    $cart['total']     = $total;
    $cart['order_id']  = $orders[0];

    return $cart;
}

/**  public function extras */
function extras ($cart_extra_id,$user=null){

    $extras = ProviderExtra::where(['cart_extra_id'=>$cart_extra_id,'user_id'=>$user])

              ->with(['extra'=>function($q){

                $q->select('id','name_'. App::getLocale() . ' as name');

        }])->select('id','extra_id','price')->latest()->get();

    $data = [];

    foreach ($extras as $extra){
        $data [] = [
            'id'       => $extra->id,
            'extra_id' => $extra->extra_id,
            'name'     => $extra->extra->name,
            'price'    => $extra->price,
        ];
    }

    return  $data;
}

/**  public function format arabic */
function format_arabic($format){

    if(App::getLocale() == 'ar'){

        $data =  date( "A" ,strtotime($format))  == 'AM' ? 'صباحاً' : 'مساءاً' ;

    }else{

        $data =  date( "A" ,strtotime($format))  == 'AM' ? 'AM ً' : 'PM ً' ;
    }

    return $data;
}
