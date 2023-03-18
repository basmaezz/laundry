<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\UserRequest;
use App\Models\AppUser;
use App\Models\CarType;
use App\Models\City;
use App\Models\Delegate;
use App\Models\educationLevel;
use App\Models\Nationality;
use App\Models\Order;
use App\Models\OrderAdditional;
use App\Models\OrderTable;
use App\Models\ProviderExtra;
use App\Models\Role;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminLogin(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials) && Auth::user()->subCategory_id =='' ) {
            return view('dashboard');
        }
        return redirect()->back()->with('error', 'Something went wrong.');
    }
    public function index(Request $request)
    {

        if(Gate::denies('users.index')){
            abort(403);
        };
        $users=User::whereNull('subCategory_id')->get();
        return view('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels=educationLevel::pluck('id','name');
        $roles=Role::pluck('id','role');
        return view('dashboard.users.create',compact(['levels','roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if(!empty($request->file('avatar'))){
            $filename = uploadFile($request->file('avatar'),'images');
        }
       $user=User::create($request->validated()+[
            'avatar'=> $filename
            ]
        );
        $user->roles()->attach([
            'role_id'=>$request->role_id,
        ]);
        return redirect()->route('users.index')->with('message', 'تمت الاضافه بنجاح !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::findorFail($id);
        if($user->level_id !=null ){
            $levels=educationLevel::all();
            return  view('dashboard.users.view',compact(['user','levels']));
        }
        return  view('dashboard.users.view',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::with('Roles')->findorFail($id);
        $roles=Role::all();
        $levels=educationLevel::all();
        return  view('dashboard.users.edit',compact(['user','levels','roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user= User::findorfail($id);
        $user->update([
            'name'=>$request->name,
            'last_name'=>$request->last_name,
             'phone'=>$request->phone,
            'birthdate'=>$request->birthdate,
            'level_id'=>$request->level_id,
            'joindate'=>$request->joindate
        ]);
        if(!empty($request->file('avatar'))){
            $filename = uploadFile($request->file('avatar'),'images');
            $user['avatar']=$filename;
        }
        $user->roles()->sync([$request->input('role_id')]);
        $user->save();
        return redirect()->route('users.index')->with('message', 'تم تعديل بيانات المستخدم بنجاح !');;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return  redirect()->back()->withErrors(['msg' => ' تم الحذف']);
    }

    public function customers(Request $request){

        $customers=AppUser::with('cities')->get();
        return view('dashboard.users.customers',compact('customers'));

    }
    public function customerDelete($id)
    {
        AppUser::find($id)->delete();
        return  redirect()->back()->withErrors(['msg' => ' تم الحذف']);
    }
    public function customerWallet($id)
    {
        $appUser=AppUser::find($id);
        return view('dashboard.users.addWallet',compact(('appUser')));
    }
    public function increaseWallet(Request $request,$id)
    {
        $appUser= AppUser::find($id);
        $messages = [
            'amount.required'=>'this Field Required'
        ];
        $validator = Validator::make($request->all(), [
            'amount'      => 'required|numeric|between:0,99999.99',
          ],$messages);

        $appUser->wallet += floatval($request->get("amount"));
        $appUser->save();
        return redirect()->route('customers.index')->with('message', 'تم الاضافه للمحفظه !');;
    }
    public function customerOrders($id){
        $orders=OrderTable::where('user_id',$id)->with('subCategories')->get();
        return view('dashboard.users.customerOrder',compact('orders'));
    }
    public function delegates(Request $request)
    {
        $delegates=Delegate::with(['appUser','appUser.cities','nationality'])->get();
        return view('dashboard.users.delegates',compact('delegates'));
    }
    public function CreateDelegate()
    {
        $cities=City::all();
        $carTypes=CarType::all();
        $years=Year::all();
        $nationalities=Nationality::all();

        return view('dashboard.users.createDelegate',compact(['cities','carTypes','nationalities','years']));
    }
    public function storeDelegate(Request $request)
    {
        if(!empty($request->file('avatar'))) {
            $filename = request('avatar')->getClientOriginalName();
            request()->file('avatar')->move(public_path() . '/images/', $filename);
        }
        if(!empty($request->file('id_image'))){
            $fileNameImageId = request('id_image')->getClientOriginalName();
            request()->file('id_image')->move(public_path().'/assets/uploads/nid_image/',$fileNameImageId);
        }
        if(!empty($request->file('medic_check'))){
            $fileNameMedicCheck = request('medic_check')->getClientOriginalName();
            request()->file('medic_check')->move(public_path().'/images/',$fileNameMedicCheck);
        }
        if(!empty($request->file('car_picture_front'))){
            $fileNameCarFront = request('car_picture_front')->getClientOriginalName();
            request()->file('car_picture_front')->move(public_path().'/assets/uploads/car_front/',$fileNameCarFront);
        }
        if(!empty($request->file('car_picture_behind'))){
            $fileNameCarBehind = request('car_picture_behind')->getClientOriginalName();
            request()->file('car_picture_behind')->move(public_path() . '/assets/uploads/car_back/' , $fileNameCarBehind);
        }
        if(!empty($request->file('car_registration'))){
            $fileNameCarRegistration = request('car_registration')->getClientOriginalName();
            request()->file('car_registration')->move(public_path() . '/assets/uploads/car_registration/' , $fileNameCarRegistration);
        }
        if($request->file('glasses_avatar')){
            $fileNameGlassesAvatar = request('glasses_avatar')->getClientOriginalName();
            request()->file('glasses_avatar')->move(public_path().'/images/' ,$fileNameGlassesAvatar);
        }
        if(!empty($request->nationality_name)){
         $nationality= Nationality::create([
                'name_en'=>$request->nationality_name,
                'name_ar'=>$request->nationality_name,
            ]);
            $nationality->save();
        }

     $user=AppUser::create([
                     'uuid' => Uuid::uuid1()->toString(),
                     'name'=>$request->name,
                    'password'=> Hash::make($request->password),
                    'email'=>$request->email,
                    'mobile'=>$request->mobile,
                    'city_id'=>$request->city_id,
                    'address'=>$request->address,
                    'avatar'=> $filename
              ]);
        $delegate= new Delegate();

       $delegate['app_user_id']=$user->id;
       $delegate['request_employment']=$request->request_employment;
       $delegate['bank_name']=$request->bank_name;
       $delegate['id_number']=$request->id_number;
       $delegate['iban_number']=$request->iban_number;
       $delegate['car_type']=$request->car_type;
       $delegate['car_plate_letter']=$request->car_plate_letter;
       $delegate['car_plate_number']=$request->car_plate_number;
       $delegate['car_manufacture_year_id']=$request->car_manufacture_year_id;
       $delegate['license_start_date']=$request->license_start_date;
       $delegate['license_end_date']=$request->license_end_date;
       $delegate['id_image']=$fileNameImageId;
       $delegate['medic_check']=$fileNameMedicCheck;
       $delegate['car_picture_front']=$fileNameCarFront;
       $delegate['car_picture_behind']=$fileNameCarBehind;
       $delegate['car_registration']=$fileNameCarRegistration;
       $delegate['glasses_avatar']=$fileNameGlassesAvatar;
       if(!empty($request->nationality_id)){
           $delegate['nationality_id']=$request->nationality_id;
       }else{
           $delegate['nationality_id']= $nationality->id;
       }
       $delegate->save();

       return redirect()->route('delegates.index')->with('message', 'تم اضافه مندوب جديد !');;
    }
    public function showDelegate($id)
    {
        $delegate=Delegate::with(['appUser','car','year'])->find($id);
        return view('dashboard.users.viewDelegate',compact('delegate'));
    }
    public function deleteDelegate($id)
    {
      $delegate=Delegate::find($id);
      User::where('id',$delegate->user_id)->delete();
      $delegate->delete();
        return  redirect()->back()->withErrors(['msg' => ' تم الحذف']);
    }

    public function editDelegate($id)
    {
        $delegate=Delegate::with(['appUser','car','year'])->find($id);
        return view('dashboard.users.editDelegate',compact('delegate'));
    }
    public function updateDelegate(Request $request,$id)
    {
      $delegate=Delegate::find($id);
        if(!empty($request->file('avatar'))) {
            $filename = request('avatar')->getClientOriginalName();
            request()->file('avatar')->move(public_path() . '/images/', $filename);
            $delegate->appUSer->Avatar=$filename;
        }
        if(!empty($request->file('id_image'))){
            $fileNameImageId = request('id_image')->getClientOriginalName();
            request()->file('id_image')->move(public_path().'/assets/uploads/nid_image/',$fileNameImageId);
            $delegate['id_image']=$fileNameImageId;
        }
        if(!empty($request->file('medic_check'))){
            $fileNameMedicCheck = request('medic_check')->getClientOriginalName();
            request()->file('medic_check')->move(public_path().'/images/',$fileNameMedicCheck);
            $delegate['medic_check']=$fileNameMedicCheck;
        }
        if(!empty($request->file('car_picture_front'))){
            $fileNameCarFront = request('car_picture_front')->getClientOriginalName();
            request()->file('car_picture_front')->move(public_path().'/assets/uploads/car_front/',$fileNameCarFront);
            $delegate['car_picture_front']=$fileNameCarFront;
        }
        if(!empty($request->file('car_picture_behind'))){
            $fileNameCarBehind = request('car_picture_behind')->getClientOriginalName();
            request()->file('car_picture_behind')->move(public_path() . '/assets/uploads/car_back/' , $fileNameCarBehind);
            $delegate['car_picture_behind']=$fileNameCarBehind;
        }
        if(!empty($request->file('car_registration'))){
            $fileNameCarRegistration = request('car_registration')->getClientOriginalName();
            request()->file('car_registration')->move(public_path() . '/assets/uploads/car_registration/' , $fileNameCarRegistration);
            $delegate['car_registration']=$fileNameCarRegistration;

        }
        if($request->file('glasses_avatar')){
            $fileNameGlassesAvatar = request('glasses_avatar')->getClientOriginalName();
            request()->file('glasses_avatar')->move(public_path().'/images/' ,$fileNameGlassesAvatar);
            $delegate['glasses_avatar']=$fileNameGlassesAvatar;

        }
      $delegate->update($request->all());
      $delegate->appUSer->update($request->all());
      $delegate->save();

      return redirect()->route('delegates.index');
    }

    public function profile()
    {
        $user=User::find(Auth::user()->id);
        $levels=educationLevel::all();
        return view('dashboard.users.profile',compact(['user','levels']));
    }
    public function updateProfile(Request $request)
    {
        $user= User::find(Auth::user()->id);

        $user->update([
            $user['name']=$request->get('name'),
            $user['last_name']=$request->get('last_name'),
            $user['password']= Hash::make($request->password),
            $user['email']=$request->get('email'),
            $user['phone']=$request->get('phone'),
            $user['level_id']=$request->get('level_id'),
            $user['birthdate']=$request->get('birthdate'),
            $user['joindate']=$request->get('joindate'),
        ]);
        if(!empty($request->file('avatar'))){
            $filename = uploadFile($request->file('avatar'),'images');
            $user['avatar']=$filename;
        }
        $user->save();
        return redirect()->route('users.index')->with('message', 'تم تعديل بيانات الملف الخاص بك !');;
    }
    public function changeDelegateStatus($id)
    {
       $delegate=Delegate::with('appUser')->find($id);
        $delegate->appUser->status=='active' ?$delegate->appUser->status='deactivated' :$delegate->appUser->status='active';
        $delegate->appUser->save();
       return redirect()->back()->with('message', 'تم تغيير نشاط المندوب !');;
    }

    public function editPassword()
    {
      $user=User::findorfail(Auth::user()->id);
      return view('dashboard.users.changePassword',compact('user'));
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required','min:6','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/','confirmed',
        ]);
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "كلمه المرور غير صحيحه !");
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
//        return view('dashboard');
//        return back()->with("status", "Password changed successfully!");
        \Auth::logout();
        return redirect('/login')->with('message', 'تم تغيير كلمه المرور بنجاح !');
    }

    public function getRegistrationRequests()
    {
     $requests=Delegate::where('registered',2)->get();

     return view('dashboard.users.registrationRequests',compact('requests'));
    }

    public function acceptRegister($id)
    {
       $delegate=Delegate::find($id);
       if($delegate->reject_reason!=''){
           $delegate->reject_reason='';
       }
       $delegate->registered=Null;
        $delegate->appUser->status='active';
       $delegate->save();
       return redirect()->route('delegates.index')->with('message', 'تم قبول طلب التسجيل !');
    }
    public function addRejectReason($id)
    {
        $delegate=Delegate::find($id);
        return view('dashboard.users.rejectReason',compact('delegate'));
    }

    public function storeRejectReason(Request $request,$id)
    {
        $delegate=Delegate::find($id);
        $delegate['reject_reason']=$request->reject_reason;
        $delegate->registered=3;
        $delegate->save();
        return redirect()->route('delegate.registrationRequests');
    }

    public function  rejectionRequests()
    {
        $delegates=Delegate::where('registered',3)->get();
        return view('dashboard.users.rejectionRegisterRequests',compact('delegates'));

    }

}

