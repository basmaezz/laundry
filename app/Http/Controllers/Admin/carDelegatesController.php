<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\Bank;
use App\Models\City;
use App\Models\Delegate;
use App\Models\OrderTable;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class carDelegatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//          $data=Delegate::where('car_wash',1)->with(['appUserTrashed','appUserTrashed.citiesTrashed'])->orderBy('id', 'DESC')->first();
//          dd($data->appUserTrashed->name);
//         if(Gate::denies('delegates.index')){
//             abort(403);
//         };
        if(request()->ajax()) {
            $data=Delegate::where('car_wash',1)->with(['appUserTrashed','appUserTrashed.citiesTrashed'])->orderBy('id', 'DESC')->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('subCategoryImage', function ($row) {
                    $image=$row->appUserTrashed->subCategory->image =='null' ? $row->appUserTrashed->subCategory->image :$row->appUserTrashed->subCategory->image;
                    return '<img style="width:40px; height:40px" src="'. $image .'" />';

                })->addColumn('subCategory', function ($row) {
                    return  $row->appUserTrashed->subCategory->name_ar ??'';
                })->addColumn('name', function ($row) {
                    return  $row->appUserTrashed->name ??'';
                })->addColumn('city', function ($row) {
                    return  $row->appUserTrashed->citiesTrashed->name_ar ??'';
                })->addColumn('mobile', function ($row) {
                    return $row->appUserTrashed->mobile ?? '';
                })->addColumn('percentage', function ($row) {
                    return '%'.$row->percentage;
                })->addColumn('monthlyOrders', function ($row) {
                    return  OrderTable::select('*')->where('delivery_id',$row->app_user_id)->whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
                })->addColumn('created_at', function ($row) {
                    return  $row->created_at->format('Y-M-D') ??'';
                })->addColumn('action', function ($row) {

                    return '

                       <div class="dropdown">
                                      <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                   <a class="dropdown-item" href="' . Route('carDelegates.edit', $row->id) . '">
                                        <i data-feather="edit-2" class="mr-50"></i><span>تعديل</span>
                                    </a>
                                    <a class="dropdown-item" href="' . Route('carDelegates.show', $row->id) . '">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>
                                    <a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>حذف</span>
                                    </a>
                                </div>
                            </div> ';

                })
                ->rawColumns(['subCategoryImage','name','city','mobile','percentage','created_at','monthlyOrders','action'])
                ->make(true);
        }
        return view('dashboard.carDelegates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $cities=City::all();
      $banks=Bank::all();
      $subCategories=subCategory::where('category_id',5)->get();
       return view('dashboard.carDelegates.create',compact(['subCategories','cities','banks']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=AppUser::create([
            'uuid'=>Uuid::uuid1()->toString(),
            'subCategory_id'=>$request->subCategory_id,
//             'avatar'=>uploadFile($request->file("avatar"), 'users_avatar'),
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->phone,
            'user_type'=>'delivery',
            'city_id'=>$request->city_id,
        ]);
        Delegate::create([
            'app_user_id'=>$user->id,
            'delivery_type'=>3,
            'bank_id'=>$request->bank_id,
            'iban_number'=>$request->iban_number,
            'car_wash'=>1,
            'percentage'=>$request->percentage
        ]);
        return redirect()->route('carDelegates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carDelegate=Delegate::where('car_wash',1)->with(['appUserTrashed','appUserTrashed.subCategory','appUserTrashed.citiesTrashed','bank'])->find($id);

        $banks=Bank::all();
        return view('dashboard.carDelegates.view',compact(['carDelegate']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $carDelegate=Delegate::where('car_wash',1)->with(['appUserTrashed','appUserTrashed.subCategory','appUserTrashed.citiesTrashed','bank'])->find($id);
      dd($carDelegate);
      $banks=Bank::all();
      return view('dashboard.carDelegates.edit',compact(['subCategories','cities','banks']));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delegateOrders($id)
    {

    }
}
