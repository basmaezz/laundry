<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $this->authorize('view',User::class);
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
        return redirect()->route('users.index');
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
            $user['name']=$request->get('name'),
            $user['last_name']=$request->get('last_name'),
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
        $user->roles()->sync([$request->input('role_id')]);
        $user->save();
        return redirect()->route('users.index');
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
        return  redirect()->back();
    }

    public function customers(Request $request){

        $customers=AppUser::with('cities')->get();
        return view('dashboard.users.customers',compact('customers'));

    }
    public function customerDelete($id)
    {
        AppUser::find($id)->delete();
        return  redirect()->back();
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
        return redirect()->route('customers.index');
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
        if(!empty($request->file('avatar'))){
            $filename = uploadFile($request->file('avatar'),'images');
        }
        if($request->file('id_image')){
            $fileNameImageId = request('id_image')->getClientOriginalName();
            request()->file('id_image')->move(public_path().'/images/',$fileNameImageId);
        }
        if($request->file('medic_check')){
            $fileNameMedicCheck = request('medic_check')->getClientOriginalName();
            request()->file('medic_check')->move(public_path().'/images/',$fileNameMedicCheck);
        }
        if($request->file('car_picture_front')){
            $fileNameCarFront = request('car_picture_front')->getClientOriginalName();
            request()->file('car_picture_front')->move(public_path().'/images/',$fileNameCarFront);
        }
        if($request->file('car_picture_behind')){
            $fileNameCarBehind = request('car_picture_behind')->getClientOriginalName();
            request()->file('car_picture_behind')->move(public_path() . '/images/' , $fileNameCarBehind);
        }
        if($request->file('car_registration')){
            $fileNameCarRegistration = request('car_registration')->getClientOriginalName();
            request()->file('car_registration')->move(public_path() . '/images/' , $fileNameCarRegistration);
        }
        if($request->file('glasses_avatar')){
            $fileNameGlassesAvatar = request('glasses_avatar')->getClientOriginalName();
            request()->file('glasses_avatar')->move(public_path().'/images/' ,$fileNameGlassesAvatar);
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
      Delegate::create([
                   'app_user_id'=>$user->id,
                   'nationality_id'=>$request->nationality_id,
                  'request_employment'=>$request->request_employment,
                  'bank_name'=>$request->bank_name,
                  'id_number'=>$request->id_number,
                  'iban_number'=>$request->iban_number,
                  'car_type'=>$request->car_type,
                  'car_plate_letter'=>$request->car_plate_letter,
                  'car_plate_number'=>$request->car_plate_number,
                  'car_manufacture_year_id'=>$request->car_manufacture_year_id,
                  'license_start_date'=>$request->license_start_date,
                  'license_end_date'=>$request->license_end_date,
                  'id_image'=>$fileNameImageId,
                   'medic_check'=>$fileNameMedicCheck,
                  'car_picture_front'=>$fileNameMedicCheck,
                  'car_picture_behind'=>$fileNameCarFront,
                  'car_registration'=>$fileNameCarBehind,
                  'glasses_avatar'=>$fileNameCarRegistration,
      ]);
       return redirect()->route('delegates.index');
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
      return redirect()->back();
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
        return redirect()->route('users.index');
    }
    public function changeDelegateStatus($id)
    {
       $delegate=Delegate::with('appUser')->find($id);
        $delegate->appUser->status=='active' ?$delegate->appUser->status='deactivated' :$delegate->appUser->status='active';
        $delegate->appUser->save();
       return redirect()->back();
    }

    public function changePassword($id)
    {

    }
}
