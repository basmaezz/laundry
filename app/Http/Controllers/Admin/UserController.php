<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\AppUser;
use App\Models\Bank;
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
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('error', 'Something went wrong.');
    }
    public function index(Request $request)
    {
        if(!Gate::allows('admins.index')){
            abort(403);
        };
        if(request()->ajax()) {
            $data = User::whereNull('subCategory_id')->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($row) {
                    return $row->hasRoleName($row);
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . Route('user.edit', $row->id) . '"  class="edit btn btn-primary btn-sm" style="width: 18px;height: 20px;" ><i class="fa fa-edit"></i></a>
             <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal"style="width: 18px;height: 20px;" ><i class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['action', 'role'])
                ->make(true);
        }
        return view('dashboard.users.index');

    }

    public function adminTrashed()
    {
        if(!Gate::allows('admins.index')){
            abort(403);
        };
        if(request()->ajax()) {
            $data = User::whereNull('subCategory_id')->onlyTrashed()->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($row) {
                    return $row->hasRoleName($row);
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . Route('users.restoreDeletedAdmins', $row->id) . '"  class="edit btn btn-success btn-sm" style="width: 18px;height: 20px;" ><i class="fa-solid fa-rotate-right"></i></a>
             <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal"style="width: 18px;height: 20px;" ><i class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['action', 'role'])
                ->make(true);
        }

        return view('dashboard.users.adminTrashed');
    }
    public function forceDelete(Request $request )
    {

        if(Gate::denies('admins.index')){
            abort(403);
        };

        if (is_numeric($request->id)) {
            User::where('id', $request->id)->forceDelete();
        }
        return  redirect()->back()->with('error', 'تم الحذف');
    }

    public function restoreDeletedAdmins($id)
    {
        $admin=User::withTrashed()->find($id);
        $admin->restore();
        return redirect()->route('users.index')->with('success', 'تم استعاده الحذف');;
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
        $user=User::with(['roles','Levels'])->findorFail($id);
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
    public function destroy(Request $request)
    {

//        if(Gate::denies('admins.index')){
//            abort(403);
//        };
        if (is_numeric($request->id)) {
            User::where('id', $request->id)->delete();
        }

        return  redirect()->back()->with('error', 'تم الحذف');
    }

    public function customers(Request $request)
    {
        if(Gate::denies('customers.index')){
            abort(403);
        };

        if(request()->ajax()) {
            $data=AppUser::where('user_type',"customer")->with('citiesTrashed')->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('city', function ($row) {
                    return  $row->citiesTrashed->name_ar??'';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . Route('customer.Orders',$row->id) . '"  class="edit btn btn-info btn-sm  custom" >عرض الطلبات</a>
                            <a href="' . Route('customer.wallet',$row->id) . '"  class="edit btn btn-info btn-sm custom" >اضافه للمحفظه </a>
             <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal"style="width: 18px;height: 20px;" ><i class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['action', 'city'])
                ->make(true);
        }
        return view('dashboard.users.customers');


    }
    public function customerDelete(Request $request)
    {
        if(Gate::denies('customers.index')){
            abort(403);
        };
        if (is_numeric($request->id)) {
            AppUser::where('id', $request->id)->delete();
        }
        return  redirect()->back()->with('error', 'تم الحذف');
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
        return redirect()->route('customers.index')->with('success', 'تم الاضافه للمحفظه !');;
    }
    public function customerOrders($id){
        if(Gate::denies('customers.index')){
            abort(403);
        };
        $orders=OrderTable::where('user_id',$id)->with(['subCategoriesTrashed'=>function($query){
            return $query->withTrashed();
        }])->get();
        return view('dashboard.users.customerOrder',compact('orders'));
    }

    public function delegates(Request $request)
    {
        if(Gate::denies('delegates.index')){
            abort(403);
        };
       if(request()->ajax()) {
            $data=Delegate::with(['appUserTrashed','appUserTrashed.citiesTrashed','nationality'])->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return  $row->appUserTrashed->name ??'';
                })->addColumn('city', function ($row) {
                    return  $row->appUserTrashed->citiesTrashed->name_ar ??'';
                })->addColumn('nationality', function ($row) {
                    return $row->nationality->name_ar ?? '';
                })->addColumn('request_employment', function ($row) {
                    return  $row->request_employment==0 ?'موظف':'عامل حر';
                })->addColumn('status', function ($row) {
                    if($row->appUserTrashed->status=='active'){
                        return'<a href="' . Route('delegate.changeDelegateStatus',$row->id) . '"  class="edit btn btn-success btn-sm custom " >'.$row->appUserTrashed->status.'</a>';

                    }else{
                        return'<a href="' . Route('delegate.changeDelegateStatus',$row->id) . '"  class="edit btn btn-danger btn-sm custom" >'.$row->appUserTrashed->status.'</a>';

                    }
                })->addColumn('created_at', function ($row) {
                    return  $row->created_at->format('Y-M-D') ??'';
                })
                ->addColumn('action', function ($row) {

                    return '
                    <a href="' . Route('delegate.edit',$row->id) . '"  class="edit btn btn-primary btn-sm" style="width: 18px;height: 20px;" ><i class="fa fa-edit"></i></a>
                            <a href="' . Route('Order.delegateOrders',$row->id) . '"  class="edit btn btn-success btn-sm customOrder " >الطلبات  </a>
                            <a href="' . Route('delegate.show',$row->id) . '"  class="edit btn btn-info btn-sm customOrder" >التفاصيل  </a>
                            <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal"style="width: 18px;height: 20px;" ><i class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['name', 'city','nationality','request_employment','status','created_at','action'])
                ->make(true);
        }
        return view('dashboard.users.delegates');
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
        $banks=Bank::all();

        return view('dashboard.users.createDelegate',compact(['cities','carTypes','nationalities','years','banks']));
    }
    public function storeDelegate(Request $request)
    {
        $request->validate([
                        'first_name'=>'required',
                        'second_name'=>'required',
                        'third_name'=>'required',
                        'mobile'=>'required|min:9|unique:app_users',
                        'city_id'=>'required',
                        'region_name'=>'required',
                        'license_end_date'=>'required',
                        'id_number'=>'required|integer|min:9|unique:delegates',
                        'identity_expiration_date'=>'required',
                        'nationality_id'=>'nullable',
                        'name_ar'=>'unique:nationalities',
                        'request_employment'=>'required',
                        'bank_id'=>'required',
                        'iban_number'=>'required|integer|min:14',
                        'car_type'=>'required',
                        'car_manufacture_year_id'=>'required',
                        'car_plate_letter1'=>'required|string',
                        'car_plate_letter2'=>'required|string',
                        'car_plate_letter3'=>'required|string',
                        'car_plate_number'=>'required|integer',
                        'avatar'=>'required|mimes:jpeg,bmp,png|max:500',
                        'id_image'=>'required|mimes:jpeg,bmp,png',
                        'medicCheck'=>'required|mimes:jpeg,bmp,png|max:500',
                        'car_picture_front'=>'required|mimes:jpeg,bmp,png|max:500',
                        'car_picture_behind'=>'required|mimes:jpeg,bmp,png|max:500',
                        'car_registration'=>'required|mimes:jpeg,bmp,png|max:500',
                        'glasses_avatar'=>'required|mimes:jpeg,bmp,png|max:500',
                      ],[
                          'mobile.unique'=>'الرقم موجود مسبقا',
                         'id_number.required'=>'رقم الهويه موجود مسبقا',
                         'unique'=>' موجود مسبقا',
                         'string'=>'حروف فقط',
                         'integer'=>'أرقام فقط',
                         'required'=>'هذا الحقل مطلوب',
                         'mobile'=>'الرقم موجود مسبقا',
                         'min'=>'أقل من 10 أرقام',
                          'max'=>'تجاوزت الحجم المسموح به فقط 1 M',
                        'mimes'=>'الصيغ المدعومه فقط jpeg,bmp,png  '
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
        if(!empty($request->file('medicCheck'))){
            $fileNameMedicCheck = request('medicCheck')->getClientOriginalName();
            request()->file('medicCheck')->move(public_path().'/images/',$fileNameMedicCheck);
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
            'name'=>$request->first_name.' '.$request->second_name.' '.$request->third_name,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
            'mobile'=>'966'.$request->mobile,
            'city_id'=>$request->city_id,
            'region_name'=>$request->region_name,
            'avatar'=>$filename,
            'user_type'=>'delivery',
            'status'=>'active',
        ]);

        $delegate= new Delegate();

       $delegate['app_user_id']=$user->id;
       $delegate['request_employment']=$request->request_employment;
       $delegate['bank_id']=$request->bank_id;
       $delegate['id_number']=$request->id_number;
       $delegate['iban_number']=$request->iban_number;
       $delegate['car_type']=$request->car_type;
       $delegate['car_plate_letter']=$request->car_plate_letter1.$request->car_plate_letter2.$request->car_plate_letter3 ;
       $delegate['car_plate_number']=$request->car_plate_number;
       $delegate['car_manufacture_year_id']=$request->car_manufacture_year_id;
       $delegate['identity_expiration_date']=$request->identity_expiration_date;
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
      return redirect()->route('delegates.index')->with('success', 'تمت الاضافه  !');
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
        $delegate=Delegate::withTrashed()->with(['appUserTrashed','car','year'])->find($id);
        return view('dashboard.users.viewDelegate',compact('delegate'));
    }
    public function deleteDelegate(Request $request)
    {

        if (is_numeric($request->id)) {
            $delegate=Delegate::find($request->id);
            AppUser::where('id',$delegate->app_user_id)->delete();
            $delegate->delete();
        }
        return  redirect()->back()->with('error', 'تم الحذف');
    }

    public function editDelegate($id)
    {

        if(Gate::denies('delegates.index')){
            abort(403);
        };
        $delegate=Delegate::with(['appUserTrashed','nationality','car','year','bank'])->find($id);

        $nationalities=Nationality::get();
        $banks=Bank::all();
        $carTypes=CarType::all();
        $years=Year::all();
        return view('dashboard.users.editDelegate',compact(['delegate','nationalities','banks','carTypes','years']));
    }
    public function updateDelegate(Request $request,$id)
    {
      $delegate=Delegate::find($id);
        if(!empty($request->file('avatar'))) {
            $filename = request('avatar')->getClientOriginalName();
            request()->file('avatar')->move(public_path() . '/images/', $filename);
            $delegate->appUserTrashed->Avatar=$filename;
        }
        if(!empty($request->file('idImage'))){
            $fileNameImageId = request('idImage')->getClientOriginalName();
            request()->file('idImage')->move(public_path().'/assets/uploads/nid_image/',$fileNameImageId);
            $delegate['id_image']=$fileNameImageId;
        }
        if(!empty($request->file('medicCheck'))){
            $fileNameMedicCheck = request('medicCheck')->getClientOriginalName();
//            request()->file('medicCheck')->move(public_path().'/images/',$fileNameMedicCheck);
            request()->file('medicCheck')->move(public_path().'/assets/uploads/medic_check/',$fileNameMedicCheck);
            $delegate['medic_check']=$fileNameMedicCheck;
        }
        if(!empty($request->file('carPictureFront'))){
            $fileNameCarFront = request('carPictureFront')->getClientOriginalName();
            request()->file('carPictureFront')->move(public_path().'/assets/uploads/car_front/',$fileNameCarFront);
            $delegate['car_picture_front']=$fileNameCarFront;
        }
        if(!empty($request->file('carPictureBehind'))){
            $fileNameCarBehind = request('carPictureBehind')->getClientOriginalName();
            request()->file('carPictureBehind')->move(public_path() . '/assets/uploads/car_back/' , $fileNameCarBehind);
            $delegate['car_picture_behind']=$fileNameCarBehind;
        }
        if(!empty($request->file('carRegistration'))){
            $fileNameCarRegistration = request('carRegistration')->getClientOriginalName();
            request()->file('carRegistration')->move(public_path() . '/assets/uploads/car_registration/' , $fileNameCarRegistration);
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
       $delegate->update([
        'request_employment'=>$request->request_employment,
        'bank_id'=>$request->bank_id,
        'id_number'=>$request->id_number,
        'iban_number'=>$request->iban_number,
        'car_type'=>$request->car_type,
        'car_plate_letter'=>$request->car_plate_letter1.$request->car_plate_letter2.$request->car_plate_letter3 ,
        'car_plate_number'=>$request->car_plate_number,
        'car_manufacture_year_id'=>$request->car_manufacture_year_id,
        'identity_expiration_date'=>$request->identity_expiration_date,
        'license_end_date'=>$request->license_end_date,
        'id_image'=>$fileNameImageId,
        'medic_check'=>$fileNameMedicCheck,
        'car_picture_front'=>$fileNameCarFront,
        'car_picture_behind'=>$fileNameCarBehind,
        'car_registration'=>$fileNameCarRegistration,
        'glasses_avatar'=>$fileNameGlassesAvatar,
      ]);
      $delegate->appUserTrashed->update($request->all());
      $delegate->save();

      return redirect()->route('delegates.index');
    }

    public function trashedDelegates()
    {

        if(request()->ajax()) {
            $data=Delegate::with(['appUserTrashed','appUserTrashed.citiesTrashed','nationality'])->onlyTrashed()->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return  $row->appUserTrashed->name ??'';
                })->addColumn('city', function ($row) {
                    return  $row->appUserTrashed->citiesTrashed->name_ar ??'';
                })->addColumn('nationality', function ($row) {
                    return $row->nationality->name_ar ?? '';
                })->addColumn('request_employment', function ($row) {
                    return  $row->request_employment==0 ?'موظف':'عامل حر';
                })->addColumn('status', function ($row) {
                    return  $row->appUserTrashed->status ??'';
                })->addColumn('created_at', function ($row) {
                    return  $row->created_at->format('Y-M-D') ??'';
                })
                ->addColumn('action', function ($row) {
                    return '
                            <a href="' . Route('Order.delegateOrders',$row->id) . '"  class="edit btn btn-success btn-sm custom" >الطلبات  </a>
                            <a href="' . Route('delegate.show',$row->id) . '"  class="edit btn btn-info btn-sm custom" >التفاصيل  </a>
                            <a href="' . Route('delegate.restoreDeletedDelegates',$row->id) . '"  class="edit btn btn-danger btn-sm" >استعاده الحذف  </a>
            ';
                })
                ->rawColumns(['name', 'city','nationality','request_employment','status','created_at','action'])
                ->make(true);
        }

        return view('dashboard.users.trashedDelegates');
    }

    public function restoreDeletedDelegates($id)
    {
        $delegate=Delegate::withTrashed()->find($id);
        AppUser::where('id',$delegate->app_user_id)->withTrashed()->restore();
        $delegate->restore();
        return redirect()->route('delegates.index')->with('success', 'تم استعاده الحذف');;
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
       $delegate=Delegate::with('appUserTrashed')->find($id);
        $delegate->appUserTrashed->status=='active' ?$delegate->appUserTrashed->status='deactivated' :$delegate->appUserTrashed->status='active';
        $delegate->appUserTrashed->save();
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

        \Auth::logout();
        return redirect('/login')->with('message', 'تم تغيير كلمه المرور بنجاح !');
    }

    public function getRegistrationRequests()
    {
        if(Gate::denies('delegates.index')){
            abort(403);
        };

        if(request()->ajax()) {
            $data = Delegate::where('registered',2)->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return  $row->appUserTrashed->name ??'';
                })->addColumn('city', function ($row) {
                    return  $row->appUserTrashed->citiesTrashed->name_ar ??'';
                })->addColumn('nationality', function ($row) {
                    return $row->nationality->name_ar ?? '';
                })->addColumn('request_employment', function ($row) {
                    return  $row->request_employment==0 ?'موظف':'عامل حر';
                })->addColumn('status', function ($row) {
                    return  $row->appUserTrashed->status ??'';
                })->addColumn('created_at', function ($row) {
                    return  $row->created_at->format('Y-M-D') ??'';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . Route('delegate.show', $row->id) . '"  class="edit btn btn-info btn-sm custom" >تفاصيل</a>
                            <a href="' . Route('delegate.acceptRegister', $row->id) . '"  class="edit btn btn-success btn-sm custom" >قبول</a>
                            <a href="' . Route('delegate.addRejectReason', $row->id) . '"  class="edit btn btn-danger btn-sm custom" >رفض</a>
             ';
                })
                ->rawColumns(['name','city','nationality','request_employment','status','created_at','action'])
                ->make(true);
        }

     return view('dashboard.users.registrationRequests');
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
       $delegate->appUserTrashed->status='active';
       $delegate->appUserTrashed->save();
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

        if(request()->ajax()) {
            $data = Delegate::where('registered',3)->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return  $row->appUserTrashed->name ??'';
                })->addColumn('city', function ($row) {
                    return  $row->appUserTrashed->citiesTrashed->name_ar ??'';
                })->addColumn('nationality', function ($row) {
                    return $row->nationality->name_ar ?? '';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . Route('delegate.show', $row->id) . '"  class="edit btn btn-info btn-sm custom" >تفاصيل</a>
                            <a href="' . Route('delegate.acceptRegister', $row->id) . '"  class="edit btn btn-success btn-sm custom" >قبول</a>
                            ';
                })
                ->rawColumns(['name','city','nationality','action'])
                ->make(true);
        }
        return view('dashboard.users.rejectionRegisterRequests');
    }

}

