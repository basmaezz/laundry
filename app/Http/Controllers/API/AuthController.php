<?php

namespace App\Http\Controllers\API;
use App;
use App\Http\Controllers\ApiController;
use App\Models\AppUser;
use App\Models\Delegate;
use App\Models\Device;
use App\Models\User;
use App\Models\Address;
use Auth;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Session;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{
    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|min:3|max:50',
            'mobile'        => 'required',
            'gender'        => 'required',
            'city_id'       => 'required',
            'region_name'   => 'required',
            'address'       => 'required',
            'building'      => 'required',
            'fcm_token'     => 'required',
        ]);

        if ($validator->passes()) {
            $number      = convert2english(request('mobile'));
            $checkPhone  = is_unique('mobile',$number,'customer');
            if ($checkPhone){
                return  apiResponse('mobile_exists',null,400,400);
            }
//
//            $checkEmail  = is_unique('email',$request->email,'customer');
//            if ($checkEmail){
//                return  apiResponse('email_exists',null,400,400);
//            }

            $user = new AppUser();
            $user->uuid         = Uuid::uuid1()->toString();
            $user->name         = $request->input("name");
            $user->mobile       = $number;
            $user->email        = $request->input("email")??'';
            $user->password     = Hash::make($request->input('password'));
            $user->gender       = $request->input("gender");
            $user->city_id      = $request->input("city_id");
            $user->region_name  = $request->input("region_name");
            $user->address      = $request->input("address");
            $user->building     = $request->input("building");
            $user->fcm_token    = $request->input("fcm_token");
            $user->lat          = $request->input("lat");
            $user->lng          = $request->input("lng");
            $user->address_description = $request->input("address_description");
            if(!empty($request->file("personal")['image'])) {
                $user->avatar = uploadFile($request->file("personal")['image'], 'users_avatar');
            }
            if(!empty($request->file("home_image"))) {
                $user->home_image = uploadFile($request->file("home_image"), 'home_image');
            }
            $user->save();
            Address::create([
                "description"   => "home",
                "app_user_id"   => $user->id,
                "city_id"       => $request->input("city_id"),
                "region_name"   => $request->input("region_name"),
                "address"       => $request->input("address"),
                "building"      => $request->input("building"),
                'lat'           => $request->input("lat"),
                'lng'           => $request->input("lng"),
                "default"       => true
            ]);

            try {
                $token=JWTAuth::fromUser($user);
                $userData = getUserObject($user);
                $userData['token'] = $token;
                return apiResponse("user_has_created_successfully",$userData);
            } catch (\Exception $ex) {
                return apiResponse("api.expected_error",[],500,500);
            }

        }else{
            return  apiResponse('data_required',$validator->errors(),400,400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkEmail(Request $request)
    {
        $validator          = Validator::make($request->all(), [
            'email'           => 'required|email',
        ]);
        if ($validator->passes()) {
            $checkEmail  = is_unique('email',$request->input('email'));
            if ($checkEmail){
                return  apiResponse('email_exists',null,400,400);
            }
            return  apiResponse('success',null,200,200);

        }else{
            return  apiResponse('data_required',$validator->errors(),400,400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkMobile(Request $request)
    {
        $validator          = Validator::make($request->all(), [
            'mobile'           => 'required',
        ]);
        if ($validator->passes()) {
            $number      = convert2english($request->input('mobile'));
            $checkEmail  = is_unique('mobile',$number);
            if ($checkEmail){
                return  apiResponse('mobile_exists',null,400,400);
            }
            return  apiResponse('success',null,200,200);

        }else{
            return  apiResponse('data_required',$validator->errors(),400,400);
        }
    }

    public function sign_up_delegate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'personal.name' => 'required',
            'personal.email' => 'email',
            //'personal.password' => 'required',
            'personal.image' => 'nullable|file',
            'personal.mobile' => 'required',
            'personal.city_id' => 'required',
            'personal.region_name' => 'required',
            'personal.nid' => 'required',

            'personal.identity_expiration_date' => 'required|date',
            'personal.nid_image' => 'required|file',
            'personal.medic_check_image' => 'required',
            'bank.id' => 'required',
            'bank.number' => 'required',
            'car.front_image' => 'required',
            'car.back_image' => 'required',
            'car.type' => 'required',
            'nationality_id'=>'required',
            'car_plate_letter'=>'required',
            'car_plate_number'=>'required',
            'car_manufacture_year_id'=>'required',
            'car.license_image' => 'required',
            'license.image' => 'required',
            'license.expire_date' => 'required|date',
            'request_employment' => 'required',
            'lat'=>'required',
            'lng'=>'required',
            'fcm_token'=>'required'
        ]);

        if ($validator->fails()) {
            $return = [
                'code' => 422,
                'message' => __('data_required'),
                'errors' => $validator->errors()->all(),
                'items' => null,
            ];
            return response()->json($return,422);
        }

        $number      = convert2english($request->get('personal')['mobile']);

        $checkPhone  = is_unique('mobile',$number,'delivery');
        $checkExist  = is_trashed('mobile',$number,'delivery');
        if ($checkPhone || $checkExist){
            return  apiResponse('mobile_exists',null,422,422);
        }

        $checkEmail  = is_unique('email',$request->get('personal')['email'],'delivery');
        $checkEmailExist  = is_trashed('email',$request->get('personal')['email'],'delivery');
        if ($checkEmail || $checkEmailExist){
            return  apiResponse('email_exists',null,422,422);
        }

        DB::beginTransaction();
            $user = new AppUser();
            $user->uuid = Uuid::uuid1()->toString();
            $user->name = $request->get("personal")['name'];
            $user->mobile = $number;
            $user->email = $request->get("personal")['email'];
            $user->password = Hash::make($number);
            $user->gender = $request->get("personal")['gender'] ?? 'm';
            $user->city_id = $request->get("personal")['city_id'];
            $user->region_name = $request->get("personal")['region_name'];
            $user->address = '';//$request->input("address");
            $user->building = '';//$request->input("building");
            $user->fcm_token = $request->get("fcm_token");
            $user->lat = $request->get("lat");
            $user->lng = $request->get("lng");
            $user->avatar = uploadFile($request->file("personal")['image'], 'users_avatar');
            $user->user_type = 'delivery';
            $user->status = 'deactivated';
            $user->save();

            $delegate = new Delegate();
            $delegate->app_user_id = $user->id;
            $delegate->nationality_id = $request->nationality_id;
            $delegate->id_number = $request->get('personal')['nid'];
            $delegate->identity_expiration_date = $request->get('personal')['identity_expiration_date'];
            $delegate->id_image = uploadFile($request->file('personal')['nid_image'], 'nid_image');
            $delegate->iban_number = $request->get('bank')['number'];
            $delegate->bank_id = $request->get('bank')['id'];
            $delegate->car_picture_front = uploadFile($request->file('car')['front_image'], 'car_front');
            $delegate->car_picture_behind = uploadFile($request->file('car')['back_image'], 'car_back');
            $delegate->car_registration = uploadFile($request->file('car')['license_image'], 'car_registration');
            $delegate->license_end_date = $request->get('license')['expire_date'];
            $delegate->car_plate_letter=$request->car_plate_letter;
            $delegate->car_plate_number=$request->car_plate_number;
            $delegate->car_manufacture_year_id=$request->car_manufacture_year_id;
            $delegate->request_employment = boolval($request->get('request_employment'));
            $delegate->driving_license = uploadFile($request->file('license')['image'], 'driving_license');
            $delegate->car_type = $request->get('car')['type'];
            $delegate->medic_check = uploadFile($request->file('personal')['medic_check_image'], 'medic_check');
            $delegate->registered='2';
            $delegate->save();
        DB::commit();

        try {

            $token=JWTAuth::fromUser($user);
            $userData = getUserObject($user);
            $userData['token'] = $token;
            $userData['delegate'] = $delegate;

            return apiResponse("user_has_created_successfully",$userData,200,201);
        } catch (\Exception $ex) {
            return apiResponse("api.expected_error",$ex->getMessage(),500,500);
        }
    }

    public function signIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
        ]);
        if ($validator->passes()) {
            $user  = AppUser::where('mobile',$request->get('mobile'))->first();
            if ($user) {
                if ($user->status == 'deactivated'){
                    return  apiResponse('auth.pending_activation',null,400,400);                }
                if ($user->status == 'blocked'){
                    return  apiResponse('auth.activation_administration',null,400,400);                }
                if($request->get('type')=='delivery'){
                    if ($user->user_type != 'delivery'){
                        return  apiResponse('auth.incorrect',null,400,400);                    }
                }
                $user->last_activity = Carbon::now();
                if ($request->has('lat')){
                    $user->lat = $request->get('lat');
                }
                if ($request->has('lng')){
                    $user->lng = $request->get('lng');
                }
                if($request->has('fcm_token')){
                    $user->fcm_token = $request->get('fcm_token');
                }
                $user->save();
                $token=JWTAuth::fromUser($user);
                $userData = getUserObject($user);
                $userData['token'] = $token;
                if($request->get('type')=='delivery'){
                    $userData['delegate'] = Delegate::where('app_user_id',$user->id)->first();
                }
                return apiResponse("api.success",$userData);
            }else {
                return  apiResponse('auth.incorrect',null,400,400);
            }
        }else {
            $return = [
                'code'      => 422,
                'message'   => __('data_required'),
                'errors'    => $validator->errors()->all(),
                'items'     => null,
            ];
            return response()->json($return,422);
        }
    }
    public function profile(Request $request)
    {
        $user = auth()->user();
        $userData = getUserObject($user);
        return apiResponse("api.success",$userData);
    }

    public function check_code(Request $request)
    {
        $validator     = Validator::make($request->all(), [
            'code'      => 'required',
        ]);

        if ($validator->passes()) {

            $JwtUser = JWTAuth::toUser();
            $user    = User::where(['id'=>$JwtUser->id ,'code'=>$request->code])->first();

            if ($user){

                $user->update(['confirm'=>1,'jwt_token'=>JWTAuth::fromUser($user)]);

                $msg = trans('auth.account_confirmed');

                return responseDataMessage($msg , userInfo( $user->id , App::getLocale()));

            }else{

                return responseJsonError(trans('auth.code_incorrect'));
            }

        }else{
            return response()->json($validator->errors());
        }
    }

    public function resend_code()
    {
        $JwtUser = JWTAuth::toUser();
        $user    = User::find($JwtUser->id);

        if (isset($user)){

            $verification = generate_code();

//          send_mobile_sms($user->phone, 'كود التفعيل الخاص بك فى تطبيق :' . $verification);

            $user->update(['code'=>$verification,'jwt_token'=>JWTAuth::fromUser($user)]);

            $msg = trans('auth.resent_activation');

            return  responseDataMessage($msg , userInfo($user->id) );
        }

        return responseJsonError(trans('auth.user_not_found'));
    }

    public function editProfile(Request $request)
    {

        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'name'          => 'required|min:3|max:50',
            'mobile'        => 'required|unique:app_users,mobile,'.$user->id,
            'gender'        => 'required',
            'email'         => 'email|unique:app_users,email,'.$user->id,
            'city_id'       => 'required',
            'region_name'   => 'required',
            'address'       => 'required',
            'building'      => 'required',
        ]);
        if ($validator->passes()) {
            $number      = convert2english($request->input("mobile"));
            $user->name = $request->input("name");
            $user->mobile = $number;
            $user->email = $request->input("email");
            $user->gender = $request->input("gender");
            $user->city_id = $request->input("city_id");
            $user->region_name = $request->input("region_name");
            $user->address = $request->input("address");
            $user->building = $request->input("building");
            if ($request->has('image')){
                $user->avatar     = uploadFile($request->file('image'),'users_avatar');
            }
            try {
                $user->save();
                $userData = getUserObject($user);
                return apiResponse("user_has_updated_successfully",$userData);
            } catch (\Exception $ex) {
                return apiResponse("api.expected_error",[],500,500);
            }
        }
        return  apiResponse('data_required',$validator->errors(),400,400);

    }

    public function editProfileDelegate(Request $request)
    {
        $user = auth()->user();

       $validator          = Validator::make($request->all(), [
            'personal.name'         => 'required',
            'personal.email'        => 'email|unique:app_users,email,'.$user->id,
            'personal.image'        => 'nullable|file',
            'personal.mobile'       => 'required|unique:app_users,mobile,'.$user->id,
            'personal.city_id'      => 'required',
            'personal.region_name'  => 'required',
            'personal.nid'          => 'required',
            'personal.nid_image'    => 'nullable|file',
            'personal.medic_check_image' => 'nullable|file',
            'bank.id'          => 'required',
            'bank.number'           => 'required',
            'car.registration_image'=> 'nullable|file',
            'car.front_image'       => 'nullable|file',
            'car.back_image'        => 'nullable|file',
            'car.type'              => 'required',
            'nationality_id'        =>'required',
            'car_manufacture_year_id'=>'required',
            'car_plate_letter'      =>'required',
            'car_plate_number'       =>'required',
            'car.license_image'     => 'nullable|file',
            'license.image'         => 'nullable|file',
            'license.expire_date'   => 'required|date',
            'request_employment'    => 'required',
        ]);

        if ($validator->fails()) {
            $return = [
                'code' => 422,
                'message' => __('data_required'),
                'errors' => $validator->errors()->all(),
                'items' => null,
            ];
            return response()->json($return,422);
        };


        $number             = convert2english($request->get("personal")['mobile']);
            $user['name']         = $request->get("personal")['name'];
            $user['mobile']       = $number;
            $user['email']        = $request->get("personal")['email'];
            $user['gender']       = $request->get("personal")["gender"] ?? $user->gender;
            $user['city_id']      = $request->get("personal")["city_id"];
            $user['region_name']  = $request->get("personal")["region_name"];
            $user['address']      = $request->get("personal")["address"] ?? $user->address;
            $user['building']     = $request->get("personal")["building"] ?? $user->building;
            $user['fcm_token']    = $request->get("fcm_token") ?? $user->fcm_token;
            $user['lat']          = $request->get("lat") ?? $user->lat;
            $user['lng']          = $request->get("lng") ?? $user->lng;

        $delegate = Delegate::where('app_user_id',$user->id)->first();

            $delegate['id_number']                = $request->get('personal')['nid'];
            $delegate['iban_number']              = $request->get('bank')['number'];
            $delegate['bank_id']                = $request->get('bank')['id'];
             $delegate['nationality_id']          =$request->nationality_id;
            $delegate['car_manufacture_year_id']  =$request->car_manufacture_year_id;
            $delegate['car_plate_letter']         =$request->car_plate_letter;
            $delegate['car_plate_number']         =$request->car_plate_number;
            $delegate['license_end_date']         = $request->get('license')['expire_date'];
            $delegate['request_employment']       = boolval($request->get('request_employment'));
            $delegate['manufacture_year']         = $request->get('car')['year'];
            $delegate['car_type']                 = $request->get('car')['type'];


        if (!empty($request->file("personal")['image'])){
            $user->avatar = uploadFile($request->file("personal")['image'],'users_avatar');
        }

        if (!empty($request->file("personal")['nid_image'])){
            $delegate->id_image = uploadFile($request->file('personal')['nid_image'],'nid_image');
        }
        if (!empty($request->file("personal")['medic_check_image'])){
            $delegate->medic_check = uploadFile($request->file('personal')['medic_check_image'],'medic_check');
        }
        if (!empty($request->file("car")['front_image'])){
            $delegate->car_picture_front = uploadFile($request->file('car')['front_image'],'car_front');
        }
        if (!empty($request->file("car")['back_image'])){
            $delegate->car_picture_behind = uploadFile($request->file('car')['back_image'],'car_back');
        }
        if (!empty($request->file("car")['license_image'])){
            $delegate->car_registration  = uploadFile($request->file('car')['license_image'],'car_registration');
        }
       if(!empty($request->file('image'))){
            $delegate['driving_license'] = uploadFile($request->file('image'),'driving_license');
        }
        try {
            $user->save();
            $delegate->save();
            $userData = getUserObject($user);
            $userData['delegate'] = $delegate;
            return apiResponse("user_has_updated_successfully",$userData);
        } catch (\Exception $ex) {
            return apiResponse("api.expected_error",$ex->getMessage(),500,500);
        }
    }

    public function editAvatar(Request $request)
    {
        $user = auth()->user();
        $validator          = Validator::make($request->all(), [
            'image'            => 'required',
        ]);
        if ($validator->passes()) {
            $user->avatar     = uploadFile($request->file('image'),'users_avatar');
            try {
                $user->save();
                $userData = getUserObject($user);
                return apiResponse("user_has_updated_successfully",$userData);
            } catch (\Exception $ex) {
                return apiResponse("api.expected_error",[],500,500);
            }
        }
        return  apiResponse('data_required',$validator->errors(),400,400);

    }

    public function edit_profile_provider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_registration'  => 'sometimes|nullable',
            'driving_license'       => 'sometimes|nullable',
            'photo_id'              => 'sometimes|nullable',
        ]);

        if ($validator->passes()) {

            $user     = User::find($request->user_id);
            $provider = ProviderData::where('user_id',$user->id)->first();

//            $checkPhone = User::where(['phone'=>$request->phone])->where('phone','<>',$user->phone)->first();
            $checkEmail = User::where(['email'=>$request->email])->where('email','<>',$user->email)->first();

            if (isset($checkPhone)){

                return responseJsonError(trans('auth.phone_unique'));
            }

            if (isset($checkEmail)){

                return responseJsonError(trans('auth.email_unique'));
            }

            $dataExcept  = Arr::except($request->all(),
                ['user_type','avatar','vehicle_registration','driving_license','photo_id']);

            if ($request->avatar){
                $dataExcept['avatar'] = uploadFile($request->avatar,'users_avatar');
            }

            if ($request->vehicle_registration){
                $dataExcept['vehicle_registration'] = uploadFile($request->vehicle_registration,'vehicle_images');
            }

            if ($request->driving_license){
                $dataExcept['driving_license'] = uploadFile($request->driving_license,'driving_licenses');
            }

            $result = array_filter($dataExcept);

            $user->update($result);

            if (!isset($provider)){

                $dataProvider = Arr::collapse([$result,['user_id'=>$user->id]]);
                ProviderData::create($dataProvider);

            }else{

                $provider->update($result);
            }

            $data  = userInfo($user->id , App::getLocale());

            return responseJsonData($data);
        }

        return response()->json($validator->errors());
    }

    public function forget_password(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phone' => 'required'
        ]);

        if($validator->passes())
        {
            $user   = User::where('phone', request('phone'))->first();

            if(isset($user)) {

                $user->code = generate_code();
                $user->save();

                $text   = 'كود التفعيل الخاص بك ';
//              send_mobile_sms($phone, $text);

                return responseDataMessage(trans('auth.code_sent') ,  userInfo($user->id , App::getLocale() ));

            }else{

                return responseJsonError(trans('auth.no_account_phone'));
            }

        }else{
            return response()->json($validator->errors());
        }
    }

    public function update_password(Request $request){

        $validator       = Validator::make($request->all(),[
            'password'   => 'required',
            'code'       => 'required',
        ]);

        if($validator->passes()){

            $JwtUser = JWTAuth::toUser();
            $user    = User::find($JwtUser->id);

            if (isset($user)){

               $checkCode = User::where(['id'=> $user->id , 'code'=>$request->code])->first();

               if (!isset($checkCode)){

                    return responseJsonError(trans('auth.code_invalid'));
               }

               $user->update(['password'=>bcrypt(request('password')) ,'jwt_token'=>JWTAuth::fromUser($user)]);

               return responseDataMessage( trans('auth.password_updated') , userInfo($user->id , App::getLocale()));

            }else{

                return responseJsonError(trans('auth.no_account_phone'));
            }

        }else{

            return response()->json($validator->errors());
        }
    }

    public function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password'  => 'required',
            'password'          => 'required',
        ]);

        if ($validator->passes()){

            $JwtUser = JWTAuth::toUser();
            $user    = User::where('id',$JwtUser->id)->first();

            if (Hash::check(request('current_password'), $user->password)) {

                $user->password = Hash::make(request('password'));

                if($user->save())

                 $msg = trans('auth.password_changed');

                 return responseDataMessage($msg , userInfo($user->id , App::getLocale()) );

            }else{

                return responseJsonError(trans('auth.password_incorrect'));
            }

        }else{
            return response()->json($validator->errors());
        }
    }

    public function log_out(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id'     => 'required',
            'device_type'   => 'required',
            'mac_address_id'=> 'required',
        ]);

        if ($validator->passes()){

            $_user   = JWTAuth::toUser();

            if (isset($request->mac_address_id)){

                $user = Device::where(['user_id'=>$_user->id,'mac_address_id'=>$request->mac_address_id])->first();

            }else{
                $user = Device::where(['user_id'=>$_user->id,'device_id'=>$request->device_id,
                    'device_type'=>$request->device_type])->first();
            }

            if (isset($user)){

                $user->delete();

                return responseJsonData(trans('auth.logged_out'));

            }else{

                $msg = 'the device id you entered is incorrect';
                return responseJsonError($msg);
            }
        }
        return response()->json($validator->errors());
    }

    public function switch_notification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'switch' => 'nullable',
        ]);

        if ($validator->passes()) {

            $JwtUser = JWTAuth::toUser();
            $user    = AppUser::find($JwtUser->id);

            if (!isset($user)){

                return responseJsonError('the user  Not found');
            }

            if (isset($request->switch)){

                $user->update(['notification' => $request->switch]);
            }

            return responseJsonData((int)$user->notification);
        }

        return response()->json($validator->errors());
    }

    public function delegateStatus(Request $request){
        // TODO :: check admin role
        $validator = Validator::make($request->all(),[
            'user_id'=>'required|exists:app_users,id',
            'status'=>'required|in:active,deactivated,blocked'
        ]);

        if ($validator->fails()) {
            $return = [
                'code' => 422,
                'message' => __('data_required'),
                'errors' => $validator->errors()->all(),
                'items' => null,
            ];
            return response()->json($return,422);
        }

        $user = AppUser::find($request->get('user_id'));

        if($user->status == $request->get('status')){
            $return = [
                'code'      => 422,
                'message'   => __('User has already same status'),
                'errors'    => 'Has same status',
                'items'     => null,
            ];
            return response()->json($return,422);
        }

        $user->status = $request->get('status');
        $user->save();

        return apiResponse("user_has_updated_successfully",$user);
    }

    public function checkAvailable(Request $request)
    {
        $JwtUser = JWTAuth::toUser();
        $user    = AppUser::where('id',$JwtUser->id)->first();
        if($user->available == '1'){
            return apiResponse("OnLine",$user);
        }elseif($user->available == '0'){
             return apiResponse("offLine",$user);
        }
    }

    public function changeAvailable(Request $request)
    {
        $JwtUser = JWTAuth::toUser();
        $user    = AppUser::where('id',$JwtUser->id)->first();
        $user->available=='1' ?$user->available='0' :$user->available='1';
        $user->save();

        $return = [
            'code'      => 200,
            'message'   => __('User has change Status'),
            'errors'    => 'Has change status',
            'available'     => $user->available,
        ];
        return response()->json($return,200);
        return apiResponse("user_has_updated_successfully",$user);
    }
}
