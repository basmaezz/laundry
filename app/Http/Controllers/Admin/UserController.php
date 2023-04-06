<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateUserRequest;
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
        if(!Gate::allows('admins.index')){
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
        if(Gate::denies('admins.index')){
            abort(403);
        };
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
        if(Gate::denies('admins.index')){
            abort(403);
        };
        if(!empty($request->file('profileImage'))){
            $filename = uploadFile($request->file('profileImage'),'images');
        }
       $user=User::create($request->validated()+[
            'avatar'=> $filename
            ]
        );
        $user->roles()->attach([
            'role_id'=>$request->role_id??'1',
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
        if(Gate::denies('admins.index')){
            abort(403);
        };
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
        if(Gate::denies('admins.index')){
            abort(403);
        };
        $user=User::with(['Roles','Levels'])->findorFail($id);

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
    public function update(updateUserRequest $request, $id)
    {
        if(!Gate::allows('admins.index')){
            abort(403);
        };
        $user=User::find($id);
        if(!empty($request->file('avatar'))){
            $filename = uploadFile($request->file('avatar'),'images');
            $user->update($request->validated()+[
                    'avatar'=>$filename,
                    'password'=> Hash::make($request->password),

            ]);
        }else{
            $user->update($request->validated()+[
                    'password'=> Hash::make($request->password),
                ]);
        }
        if($request->role_id!=''){
            $user->Roles()->sync( [
                'role_id' => $request->role_id
            ]);
        }
        return  redirect()->route('users.index')->with('message', 'تم التعديل بنجاح !');;;


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('admins.index')){
            abort(403);
        };
        User::find($id)->delete();
        return  redirect()->back()->withErrors(['msg' => ' تم الحذف']);
    }

    public function customers(Request $request)
    {
        if(Gate::denies('customers.index')){
            abort(403);
        };
        $customers=AppUser::with('cities')->get();
        return view('dashboard.users.customers',compact('customers'));

    }
    public function customerDelete($id)
    {
        if(Gate::denies('customers.index')){
            abort(403);
        };
        AppUser::find($id)->delete();
        return  redirect()->back()->withErrors(['msg' => ' تم الحذف']);
    }
    public function customerWallet($id)
    {
        if(Gate::denies('customers.index')){
            abort(403);
        };
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
        if(Gate::denies('customers.index')){
            abort(403);
        };
        $orders=OrderTable::where('user_id',$id)->with('subCategories')->get();
        return view('dashboard.users.customerOrder',compact('orders'));
    }
    public function delegates(Request $request)
    {
        if(Gate::denies('delegates.index')){
            abort(403);
        };
        $delegates=Delegate::with(['appUser','appUser.cities','nationality'])->get();
        return view('dashboard.users.delegates',compact('delegates'));
    }
    public function CreateDelegate()
    {
        if(Gate::denies('delegates.index')){
            abort(403);
        };
        $cities=City::all();
        $carTypes=CarType::all();
        $years=Year::all();
        $nationalities=Nationality::all();

        return view('dashboard.users.createDelegate',compact(['cities','carTypes','nationalities','years']));
    }
    public function storeDelegate(Request $request)
    {
        $request->validate([
                        'name'=>'required',
                        'mobile'=>'required|integer|min:10|unique:app_users',
                        'city_id'=>'required',
                        'address'=>'required',
                        'id_number'=>'required|integer|min:10|unique:delegates',
                        'license_start_date'=>'required',
                        'nationality_id'=>'nullable',
                        'name_ar'=>'unique:nationalities',
                        'request_employment'=>'required',
                        'bank_name'=>'required',
                        'iban_number'=>'required|integer|min:14',
                        'car_type'=>'required',
                        'car_manufacture_year_id'=>'required',
                        'car_plate_letter'=>'required|string',
                        'car_plate_number'=>'required|integer',
                        'avatar'=>'required',
                        'id_image'=>'required',
                        'medic_check'=>'required',
                        'car_picture_front'=>'required',
                        'car_picture_behind'=>'required',
                        'car_registration'=>'required',
                        'glasses_avatar'=>'required',
                        'license_end_date'=>'required',

        ],[
            'unique'=>'الاسم موجود مسبقا',
            'string'=>'حروف فقط',
            'integer'=>'أرقام فقط',
            'required'=>'هذا الحقل مطلوب',
            'mobile'=>'الرقم موجود مسبقا',
            'min'=>'أقل من 10 أرقام'
        ]);
        $user=new AppUser();
        if(!empty($request->file('avatar'))) {
            $filename = request('avatar')->getClientOriginalName();
            request()->file('avatar')->move(public_path() . '/images/avatar/', $filename);
            $user['avatar']= $filename;
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
            'uuid'=>Uuid::uuid1()->toString(),
            'name'=>$request->name,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'city_id'=>$request->city_id,
            'address'=>$request->address,
            'avatar'=>$filename,
            'user_type'=>'delivery',
            'status'=>'active',
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
  if( $delegate){
      $delegate->save();
      return redirect()->route('delegates.index')->with('message', 'تم اضافه مندوب جديد !');
  }else{
      AppUser::where('id',$user->id)->delete();
      return  redirect()->back();
  }

    }
    public function showDelegate($id)
    {
        if(Gate::denies('delegates.index')){
            abort(403);
        };
        $delegate=Delegate::with(['appUser','car','year'])->find($id);
        return view('dashboard.users.viewDelegate',compact('delegate'));
    }
    public function deleteDelegate($id)
    {
        if(Gate::denies('delegates.index')){
            abort(403);
        };
      $delegate=Delegate::find($id);
      User::where('id',$delegate->user_id)->delete();
      $delegate->delete();
        return  redirect()->back()->withErrors(['msg' => ' تم الحذف']);
    }

    public function editDelegate($id)
    {
        if(Gate::denies('delegates.index')){
            abort(403);
        };
        $delegate=Delegate::with(['appUser','nationality','car','year'])->find($id);
        $nationalities=Nationality::get();
        return view('dashboard.users.editDelegate',compact(['delegate','nationalities']));
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
        if(!empty($request->nationality_name)){
            $nationality= Nationality::create([
                'name_en'=>$request->nationality_name,
                'name_ar'=>$request->nationality_name,
            ]);
            $nationality->save();
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
            $user['joinDate']=$request->get('joinDate'),
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
        if(Gate::denies('delegates.index')){
            abort(403);
        };
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
        if(Gate::denies('delegates.index')){
            abort(403);
        };
     $requests=Delegate::where('registered',2)->get();

     return view('dashboard.users.registrationRequests',compact('requests'));
    }

    public function acceptRegister($id)
    {
        if(Gate::denies('delegates.index')){
            abort(403);
        };
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
        if(Gate::denies('delegates.index')){
            abort(403);
        };
        $delegate=Delegate::find($id);
        return view('dashboard.users.rejectReason',compact('delegate'));
    }

    public function storeRejectReason(Request $request,$id)
    {
        $delegate=Delegate::find($id);
        $delegate['reject_reason']=$request->reject_reason;
        $delegate->registered=3;
        $delegate->save();
        return redirect()->route('delegate.rejectionRequests');
    }

    public function  rejectionRequests()
    {
        $delegates=Delegate::where('registered',3)->get();
        return view('dashboard.users.rejectionRegisterRequests',compact('delegates'));

    }

}

