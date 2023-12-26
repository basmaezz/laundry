<?php

use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\OptionsBuilder;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\ProductService;
use App\Models\RequestDelivery;
use App\SmsEmailNotification;
use App\Models\MoneyAccount;
use Illuminate\Support\Str;
use App\Models\Notifications;
use App\Models\SiteSetting;
use LaravelFCM\Facades\FCM;
use App\Models\BankAccount;
use App\Models\Permission;
use App\Models\Subcategory;
use App\Models\Favorite;
use App\Models\Category;
use App\Models\Product;
use App\Models\Contact;
use App\Models\Branche;
use App\Models\Package;
use App\Models\Social;
use App\Models\Report;
use App\Models\Order;
use App\Models\Service;
use App\Models\Client;
use App\Models\Banner;
use App\Models\Page;
use App\Models\Role;
use App\Models\Html;
use Carbon\Carbon;
use App\User;
//use File;

function Home()
{

    $colors = ['#1abc9c','#2ecc71','#3498db','#9b59b6','#7FB3D5','#e67e22','#229954','#f39c12','#F6CD61','#FE8A71','#199EC7'];
    $home   = [
        [
            'name'  => 'مقدمين الخدمة',
            'count' => User::where('user_type','provider')->count(),
            'icon'  => '<i class="icon-users"></i>',
            'color' => $colors[array_rand($colors)]
        ],
        [
            'name'  => 'الاعضاء',
            'count' => User::where('user_type','user')->count() -1,
            'icon'  => '<i class="icon-users"></i>',
            'color' => $colors[array_rand($colors)]
        ],
        [
            'name'  => 'المناديب',
            'count' => User::where('user_type','delegate')->count(),
            'icon'  => '<i class="icon-reading"></i>',
            'color' => $colors[array_rand($colors)]
        ],
        [
            'name'  => 'المنتجات',
            'count' => Product::where('category_type','category')->count(),
            'icon'  => '<i class="glyphicon glyphicon-briefcase"></i>',
            'color' => $colors[array_rand($colors)]
        ],
//        [
//          'name'  => 'منتجات المتجر',
//          'count' => Product::where('category_type','store')->count(),
//          'icon'  => '<i class="glyphicon glyphicon-shopping-cart"></i>',
//          'color' => $colors[array_rand($colors)]
//        ],
        [
            'name'  => 'الطلبات الجديدة',
            'count' => Order::where('status','current')->count(),
            'icon'  => '<i class="glyphicon glyphicon-list-alt"></i>',
            'color' => $colors[array_rand($colors)]
        ],
        [
            'name'  => 'الاقسام الرئيسية',
            'count' => Category::count(),
            'icon'  => '<i class="glyphicon glyphicon-align-justify"></i>',
            'color' => $colors[array_rand($colors)]
        ],
        [
            'name'  => 'الاقسام الفرعية',
            'count' =>  Subcategory::count(),
            'icon'  => '<i class="glyphicon glyphicon-align-center"></i>',
            'color' => $colors[array_rand($colors)]
        ],
//        [
//          'name'  => 'طلبات التوصيل',
//          'count' =>  RequestDelivery::where('status',0)->count(),
//          'icon'  => '<i class="icon-truck"></i>',
//          'color' => $colors[array_rand($colors)]
//        ],
//        [
//          'name'  => 'الفروع',
//          'count' =>  Branche::where('deleted',0)->count(),
//          'icon'  => '<i class="glyphicon glyphicon-list"></i>',
//          'color' => $colors[array_rand($colors)]
//        ],
//        [
//          'name'  => 'الباقات',
//          'count' =>  Package::where('deleted',0)->count(),
//          'icon'  => '<i class="icon-bookmark"></i>',
//          'color' => $colors[array_rand($colors)]
//        ],
        [
            'name'  => 'الرسائل الجديدة',
            'count' =>  Contact::where('ShowOrNow',0)->count(),
            'icon'  => '<i class="glyphicon glyphicon-envelope"></i>',
            'color' => $colors[array_rand($colors)]
        ],
        [
            'name'  => 'الصور المتحركة',
            'count' =>  Banner::count(),
            'icon'  => '<i class="glyphicon glyphicon-picture"></i>',
            'color' => $colors[array_rand($colors)]
        ],
        [
            'name'  => 'العملاء',
            'count' =>  Client::count(),
            'icon'  => '<i class="glyphicon glyphicon-bookmark"></i>',
            'color' => $colors[array_rand($colors)]
        ],
        [
            'name'  => 'الحسابات البنكية',
            'count' =>  BankAccount::count(),
            'icon'  => '<i class="glyphicon glyphicon-usd"></i>',
            'color' => $colors[array_rand($colors)]
        ],
        [
            'name'  => 'التحويلات البنكية الجديدة',
            'count' =>  MoneyAccount::where('status',0)->count(),
            'icon'  => '<i class="icon-cash3"></i>',
            'color' => $colors[array_rand($colors)]
        ],
    ];

    return $blocks[]=$home;
}

#role name
function Role()
{
    $role = Role::findOrFail(Auth::user()->role);

    return isset($role) ? $role->role :  'عضو';
}

function getUserLocation($distance){
    if ($distance <=  10){
        return 'IN_AREA';
    }
    else{
        return 'OUT_AREA';
    }
}

function getDistanceClass($distance,$range){
//    if ($distance <=  config('setting.distance.in_area')){
    if ($distance <=  $range){
        return 'IN_AREA';
    }
//    elseif ($distance <= config('setting.distance.away_area') && $distance < config('setting.distance.out_area')){
//        return 'AWAY_AREA';
//    }
    else{
        return 'OUT_AREA';
    }
}

function getDistanceClassId($distance,$range){
//    if ($distance <= config('setting.distance.in_area')){
    if ($distance <= $range){
        return 1;
    }
//    elseif ($distance <= config('setting.distance.away_area') && $distance < config('setting.distance.out_area')){
//        return 2;
//    }
    else{
        return 3;
    }
}

#messages notification
function Notification()
{
    $messages = Contact::where('showOrNow',0)->latest()->get();

    return $messages;
}

#current route
function currentRoute()
{
    $routes = Route::getRoutes();

    foreach ($routes as $value)
    {
        if( $value->getName() === Route::currentRouteName() ){

            echo $value->getAction()['title'] ;
        }
    }
}

function History( $user_id , $event )
{
    $report = new Report;
    $user   = User::findOrFail($user_id);

    if($user->role > 0)
    {
        $report->user_id    = $user->id;
        $report->event      = 'قام '.$user->name .' '.$event;
        $report->supervisor = 1;
        $report->save();

    }else{

        $report->user_id    = $user->id;
        $report->event      = 'قام '.$user->name .' '.$event;
        $report->supervisor = 0;
        $report->save();
    }

}

#email colors
function EmailColors()
{
    $html = Html::select('email_header_color','email_footer_color','email_font_color')->first();
    return $html;
}

function convert2english($string) {

    $newNumbers = range(0, 9);
    $arabic     = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $string     =  str_replace($arabic, $newNumbers, $string);

    return $string;
}

function is_unique($key,$value,$type = null){

    $user = \App\Models\AppUser::where($key , $value);
    if($type){
        $user = $user->where('user_type',$type);
    }
    $user = $user->first();
    if( $user ){
        return true;
    }
    return false;
}
function is_trashed($key,$value,$type = null){

    $user = \App\Models\AppUser::where($key , $value)->withTrashed();
    if($type){
        $user = $user->where('user_type',$type);
    }
    $user = $user->first();
    if($user){
        return true;
    }
    return false;
}

function is_unique2($key,$value){

    $coupon = \App\Models\CouponShopCart::where($key , $value)->first();
    if( $coupon ){
        return true;
    }
    return false;
}

function generate_code() {

    $characters = '7917391698648';
    $charactersLength = strlen($characters);
    $token   = '';
    $length  = 4;

    for ($i  = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, $charactersLength - 1)];
    }
    return '1234';
//    return $token;
}

#No3man
function shorten_string($string, $numberWords)
{
    $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
    $string = str_replace("\n", " ", $string);
    $array  = explode(" ", $string);

    if (count($array) <= $numberWords){

        $words = $string;

    }else{

        array_splice($array, $numberWords);
        $words = implode(" ", $array)." ...";
    }

    return $words;
}

#No3man
function Send_FCM($device_id,$sent_data,$device_type='android')
{

    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60*20);
    $notificationBuilder = new PayloadNotificationBuilder('رسالة جديدة');
    $notificationBuilder->setBody('LAUNDRY')->setSound('default');

    $option = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData($sent_data);
    $data = $dataBuilder->build();
    $token = $device_id;

    if($device_type == 'android'){
        $downstreamResponse = FCM::sendTo($token, $option, null, $data);
    }else{
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
    }

    $downstreamResponse->numberSuccess();
    $downstreamResponse->numberFailure();
    $downstreamResponse->numberModification();
}



function SendFcm($device_id,$data,$title,$device_type='android',$usrNotification = 1)
{
    $optionBuilder = new OptionsBuilder();
    $priority = 'high';
    $optionBuilder->setPriority($priority);
    $optionBuilder->setTimeToLive(60*20);

    $notificationBuilder = new PayloadNotificationBuilder('LAUNDRY',$title);
    if ($device_type == 'ios'){
        $notificationBuilder->setBody($title,$title)->setSound('default');
    }else{
        $notificationBuilder->setBody('Bubbles',$title)->setSound('default');
    }
    $option = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $dataBuilder  = new PayloadDataBuilder();

    $dataBuilder->addData($data);

    $data   = $dataBuilder->build();
    $device = $device_type;
    $token  = $device_id;

    if ($token != null && $usrNotification == 1) {
        if ($device == 'android'){
            $downstreamResponse = FCM::sendTo($token, $option, NULL, $data);
        }else{
            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        }
        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
    }

}

#No3man
function Fcm_Topic($message){

    $title   = ['msg'=> $message,'type'  => 'offer'];
    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setPriority('high');
    $optionBuilder->setTimeToLive(60*20);
    $notificationBuilder = new PayloadNotificationBuilder('عرض جديد');
    $notificationBuilder->setBody($message,$message)->setSound('default');

    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData($title);
    $option = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();

    $topic = new Topics();
    $topic->topic('offers');
    FCM::sendToTopic($topic, $option, $notification, $data);
}


#No3man
function getDistance($result, $latitude, $longitude)
{
    $results = $result->select('*')->selectRaw("( 3959 * acos( cos( radians($latitude) ) * cos( radians( lat ) )
       * cos( radians( lng ) - radians($longitude) ) + sin( radians($latitude) )
       * sin(radians(lat))) )  AS distance ")->orderBy('distance')->first();

    return $results;
}

#No3man
function GetDistanceData($result, $latitude, $longitude)
{
    $results = $result->select('*')->selectRaw("( 3959 * acos( cos( radians($latitude) ) * cos( radians( lat ) )
       * cos( radians( lng ) - radians($longitude) ) + sin( radians($latitude) )
       * sin(radians(lat))) )  AS distance ")->orderBy('distance')->get();

    return $results;
}

#No3man
function getDistanceHaving($result, $latitude, $longitude,$distance = null){

    $range = isset($distance) ? $distance :  setting()->distance_range;

    $raw   = DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) *cos( radians( lat ) )
           * cos( radians( lng ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') )
           * sin( radians( lat ) ) ) )  AS distance');

    $results = $result->select('*', $raw)->addSelect($raw)->orderBy('distance' ,'asc')->having('distance', '<=', $range)->get();

    return $results;
}

function distance($lat1 = null, $lon1= null, $lat2= null, $lon2= null, $unit='K') {
    if(empty($lat1) || empty($lat2) || empty($lon1) || empty($lon2)){
        return 0;
    }
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
    }
    else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}
#No3man
function getDistanceFirst($user, $latitude, $longitude)
{
    $raw   = DB::raw(' ( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( lat ) )
           * cos( radians( lng ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') )
           * sin( radians( lat ) ) ) )  AS distance');

    $results = $user->select('*', $raw)->addSelect($raw)->orderBy('distance')->first();

    return $results;
}
function getDistanceFirst1($user, $latitude, $longitude)
{
    if(empty($latitude) || empty($longitude) || empty($user)){
        return 0;
    }
    $raw   = DB::raw(' ( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( lat ) )
           * cos( radians( lng ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') )
           * sin( radians( lat ) ) ) )  AS distance');

    $results = $user->select('*', $raw)->addSelect($raw)->orderBy('distance')->first();
    return $results->distance;
}
function getStatus($laundry)
{
    if($laundry->around_clock =='1'){
        return 1;
    }elseif($laundry->around_clock =='0'){
        $startDate=$laundry->clock_at;
        $endDate=$laundry->clock_end;
        $check = Carbon::now()->between($startDate, $endDate, true);
        if($check){
            return 1;
        }else{
            return 0;
        }
    }

}
function minutesToHumanReadable($minutes){

    $d = floor ($minutes / 1440);
    $h = floor (($minutes - $d * 1440) / 60);
    $m = $minutes - ($d * 1440) - ($h * 60);
//
// Then you can output it like so...
//
    return "{$d} يوم - {$h} ساعة - {$m} دقيقة";
}

#No3man
function responseJsonData($data){
    $response = [
        'value'  =>  '1' ,
        'key'    => 'success',
        'data'   => $data,
    ];
    return $response;

}

#No3man
function responseJsonError($message)
{
    $response = ['value' => '0','key' => 'fail','msg' => $message];

    return $response;
}

#No3man
function responseDataMessage($message , $data){

    $response = ['value' => '1' ,'key' => 'success','msg' => $message,'data' => $data];

    return $response;
}


function uploadFile($fileAttr, $path = ""){

    $imgName = mt_rand(1000, 9999).microtime(true).'.'.$fileAttr->getClientOriginalExtension();
    $fileAttr->move(public_path('assets/uploads/'.$path),$imgName);
    return $imgName;
}

function deleteFile($file , $path = ""){

    File::delete('assets/uploads/'.$path.'/'. $file);
}

function assets(){

    return url('assets/site/');
}

function assetsDashboard(){

    return url('assets/dashboard/');
}

function assetsUpload(){

    return url('assets/uploads/');
}

function setting(){

    $setting = SiteSetting::first();

    return $setting;
}

function social($name){

    $data = Social::where('name',$name)->first();

    return $data->link;
}

function page($name){

    $data = Page::where('name',$name)->first();

    return $data;
}

function unseen_notification(){

    $count = Auth::check() ? Notifications::where(['seen'=>0,'user_id'=>Auth::id()])->count() : 0 ;

    return $count;
}

function before_current_route(){

    $route = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();

    return $route;
}

function lang($text = null){
    return in_array($text, ['name', 'title', 'desc'])
        ? $text. '_' . app()->getLocale()
        : app()->getLocale();
}

function jsValidation($request, $form)
{
    return JsValidator::formRequest('App\Http\Requests\\' . $request , $form);
}

/**
 * @param string $message_key
 * @param null $items
 * @param int $code
 * @param int $http_code
 * @return \Illuminate\Http\JsonResponse
 */

function apiResponse(string $message_key, $items=null,$categories=null,int $code=200,int $http_code=200)
{
    $return = [];
    $return["code"]= $code;
    $return["message"]= __($message_key);
    $return["items"] = $items;
    $return["categories"] = $categories?$categories :'';
    return response()->json($return,$http_code);
}
function apiDelegateWalletResponse(string $message_key, $balance=null,int $code=200,int $http_code=200)
{
    $return = [];
    $return["code"]= $code;
    $return["message"]= __($message_key);
    $return["balance"] = $balance;
    return response()->json($return,$http_code);
}

function apiResponse1(string $message_key, $data=null,$items=null,int $code=200,int $http_code=200)
{
    $return = [];
    $return["code"]= $code;
    $return["message"]= __($message_key);
    $return["data"] = $data;
    $return["items"] = $items;
    return response()->json($return,$http_code);
}
function apiResponse2( $items=null,int $code=200,int $http_code=200)
{
    $return = [];
    $return["code"]= $code;
    $return["items"] = $items;
    return response()->json($return,$http_code);
}
function apiResponseOrders1(string $message_key, $orders=null,int $code=200,int $http_code=200)
{
    $return = [];
    $return["code"]= $code;
    $return["message"]= __($message_key);
    $return["orders"] = $orders;
    return response()->json($return,$http_code);
}

function apiResponseCoupon(string $message_key, $discount_value=null,int $code=200,int $http_code=200)
{
    $return = [];
    $return["code"]= $code;
    $return["message"]= __($message_key);
    $return["discount_value"] = $discount_value;
    return response()->json($return,$http_code);
}
function apiResponseCouponError(string $message_key, int $code=400,int $http_code=200)
{
    $return = [];
    $return["code"]= $code;
    $return["message"]= __($message_key);
    return response()->json($return,$http_code);
}
function apiResponseOrders(string $message_key,  $new_orders=null,$items=null,int $code=200,int $http_code=200)
{
    $return = [];
    $return["code"]= $code;
    $return["message"]= trans($message_key);
    $return["new_orders"] = $new_orders;
    $return["orders"] = $items;
    return response()->json($return,$http_code);
}
function apiResponseDelegateOrders(string $message_key,$delegate_range=null  ,$deliver_carpet=null,$new_orders=null,$items=null,int $code=200,int $http_code=200)
{
    $return = [];
    $return["code"]= $code;
    $return["message"]= trans($message_key);
    $return["delegate_range"] = $delegate_range;
    $return["deliver_carpet"] = $deliver_carpet;
    $return["new_orders"] = $new_orders;
    $return["orders"] = $items;
    return response()->json($return,$http_code);
}
function getUserObject($user)
{
    $title='title_'.app()->getLocale();
    return [
        'id' => $user->id,
        'name' => $user->name,
        'point' => $user->point,
        'wallet' => $user->wallet,
        'mobile' => $user->mobile,
        'email' => $user->email,
        'title' => $user->title?$user->title->$title:'',
        'status' => $user->status,
        'city_id' => $user->city_id,
        'city_name' => $user->citiesTrashed?->name,
        'region_name' => $user->region_name,
        'address' => $user->address,
        'building' => $user->building,
        'gender' => $user->gender,
        'lat' => $user->lat,
        'lng' => $user->lng,
        'address_description' => $user->address_description,
        'ordersCount' => $user->orders_count,
        'image' => $user->avatar?asset('assets/uploads/users_avatar/'.$user->avatar):null,
        'home_image' => $user->avatar?asset('assets/uploads/home_image/'.$user->home_image):null,
    ];
}

function getNotificationObj($status_id){
    switch ($status_id){
        case \App\Http\Controllers\API\OrderController::WaitingForDelivery:
            $title = "استلمتا طلبك بنجاح !";
            $description = "جّهز ملابسك في كيس، مندوبنا جايك ! 💨 🏎️";
            break;
        case \App\Http\Controllers\API\OrderController::AcceptedByDelivery:
            $title = "المندوب في الطريق !";
            $description = " دقايق والمندوب عندك ، خلك حول جّوالك 📱";
            break;
        /*case \App\Http\Controllers\API\OrderController::DeliveryOnWay:
            $title = "";
            $description = "";
            break;*/
        case \App\Http\Controllers\API\OrderController::WayToLaundry:
            $title = "ملابسك بنحطها بعيونا";
            $description = "ملابسك في الطريق للمغسلة مع مندوبنا";
            break;
        case \App\Http\Controllers\API\OrderController::DeliveredToLaundry:
            $title = "ملابسك في المغسلة";
            $description = "ملابسك وصلت المغسلة وبس تجهز بنعطيك خبر 💦";
            break;
        case \App\Http\Controllers\API\OrderController::ClothesReadyForDelivery:
            $title = "ملابسك جاهزة للاستلام ✅";
            $description = ": نرجو اختيار طريقة الاستلام المناسبة لك";
            break;
        case \App\Http\Controllers\API\OrderController::WaitingForDeliveryToReceiveOrder:
            $title = "تم استلام طلب التوصيل بنجاح";
            $description = "ارتاح و مندوبنا بيجيبلك الملابس في اسرع وقت .";
            break;
        case \App\Http\Controllers\API\OrderController::AcceptedByDeliveryToYou:
            $title = "دقايق و ملابسك عندك !";
            $description = "مندوبنا بيستلم الملابس ويجيبها حاًال 💨 🏎️";
            break;
        /*case \App\Http\Controllers\API\OrderController::DeliveryOnTheWayToYou:
            $name = trans('api.Delivery on the way to you');
            break;*/
        case \App\Http\Controllers\API\OrderController::Completed:
            $title = "ملبوس العافية ❤️";
            $description = "شكرا لتعاملك مع لاندري وملبوس العافية ";
            break;
        case \App\Http\Controllers\API\OrderController::Cancel:
            $title = "تم الغاء الطلب";
            $description = "تم الغاء طلبك وشكرا لتعاملك مع لاندري";
            break;
        default:
            $title = 'Empty ['.$status_id.']';
            $description = 'Empty ['.$status_id.']';
            break;
    }
    return ['title'=>$title, 'description' => $description];
}
function getCarpetNotificationObj($status_id){
    switch ($status_id){
        case \App\Http\Controllers\API\OrderController::WaitingForDelivery:
            $title = "استلمتا طلبك بنجاح !";
            $description = "جّهز السجاد، مندوبنا جايك ! 💨 🏎️";
            break;
        case \App\Http\Controllers\API\OrderController::DeliveredToLaundry:
            $title = "سجادك في المغسلة";
            $description = "سجادك وصل المغسلة وبس يجهز بنعطيك خبر 💦";
            break;
        case \App\Http\Controllers\API\OrderController::Completed:
            $title = "السجاد جاهز ❤️";
            $description = "شكرا لتعاملك مع لاندري   ";
            break;
        default:
            $title = 'Empty ['.$status_id.']';
            $description = 'Empty ['.$status_id.']';
            break;
    }
    return ['title'=>$title, 'description' => $description];

}
function getStatusName($status_id){
    switch ($status_id){
        case \App\Http\Controllers\API\OrderController::WaitingForDelivery:
            $name = trans('api.Waiting for delivery');
            break;
        case \App\Http\Controllers\API\OrderController::AcceptedByDelivery:
            $name = trans('api.Accepted by delivery');
            break;
        /*case \App\Http\Controllers\API\OrderController::DeliveryOnWay:
            $name = trans('api.Delivery on the way to you');
            break;*/
        case \App\Http\Controllers\API\OrderController::WayToLaundry:
//            $name = trans('api.on the way to laundry');
            $name = trans('api.way_to_laundry');
            break;
        case \App\Http\Controllers\API\OrderController::DeliveredToLaundry:
//            $name = trans('api.Delivered to laundry');
            $name = trans('api.Delivered_to_laundry');
            break;
        case \App\Http\Controllers\API\OrderController::ClothesReadyForDelivery:
//            $name = trans('api.clothes are ready for delivery');
            $name = trans('api.clothes_ready_delivery');
            break;
        case \App\Http\Controllers\API\OrderController::WaitingForDeliveryToReceiveOrder:
//            $name = trans('api.Waiting for delivery to receive order');
            $name = trans('api.Waiting_delivery_receive_order');
            break;
        case \App\Http\Controllers\API\OrderController::AcceptedByDeliveryToYou:
//            $name = trans('api.your clothes in the way');
            $name = trans('api.your_clothes_way');
            break;
        /*case \App\Http\Controllers\API\OrderController::DeliveryOnTheWayToYou:
            $name = trans('api.Delivery on the way to you');
            break;*/
        case \App\Http\Controllers\API\OrderController::Completed:
//            $name = trans('api.completed');
            $name = trans('api.order_completed');

            break;
        case \App\Http\Controllers\API\OrderController::Cancel:
            $name = trans('api.cancel');
            break;
        default:
            $name = 'Empty ['.$status_id.']';
            break;
    }
    return $name;
}

