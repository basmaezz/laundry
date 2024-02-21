<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\Bank;
use App\Models\carService;
use App\Models\Category;
use App\Models\City;
use App\Models\Delegate;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr\FuncCall;
use Ramsey\Uuid\Uuid;

class carLaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if(request()->ajax()) {
            $data = Subcategory::where('category_id',5)->orderBy('id','desc')->get();

            return   Datatables::of($data)
                ->addColumn('action', function ($row) {
                    return '
                              <div class="dropdown">
                               <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">

                                    <a class="dropdown-item" href="' . Route('carServices.index', $row->id) . '">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>الخدمات</span>
                                    </a>
                                     <a class="dropdown-item" href="' . Route('carLaundries.edit', $row->id) . '">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>تعديل</span>
                                    </a>
                                    <a class="dropdown-item" id="deleteBtn" data-id="' . $row->id . '"  data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>حذف</span>
                                    </a>
                                </div>
                            </div>  ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.carLaundries.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::pluck('id', 'name_ar');
        $categories = Category::where('id',5)->toBase()->get();
        $banks=Bank::all();
        return view('dashboard.carLaundries.create', compact(['cities', 'categories','banks']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subcategory=Subcategory::create($request->all()+[
                'price'=>0,
                'category_id'=>5,
                'around_clock' => $request->around_clock,
                'clock_end' =>$request->clock_end,
                'clock_at' => $request->clock_at,
            ]);
        $user=AppUser::create([
            'uuid'=>Uuid::uuid1()->toString(),
            'subCategory_id'=>$subcategory->id,
            'avatar'=>uploadFile($request->file("avatar"), 'users_avatar'),
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'mobile' => $request->phone,
            'user_type'=>'delivery',
            'subCategory_id' => $subcategory->id
        ]);
        Delegate::create([
            'app_user_id'=>$user->id,
            'bank_id'=>$request->bank_id,
            'iban_number'=>$request->iban_number
        ]);
        return redirect()->route('carLaundries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carLaundry=Subcategory::find($id);
        return view('dashboard.carLaundries.edit',compact('carLaundry'));

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
        $request->validate([
            'name_ar'=>'required',
            'name_en'=>'required',
            'lat'=>'required',
            'lng'=>'required',
            'range'=>'required',
        ],[
            'required'=>'اجبارى',
        ]);
        Subcategory::where('id',$id)->update($request->except(['_token']));

        return redirect()->route('carLaundries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (is_numeric($request->id)) {
            subCategory::where('id', $request->id)->delete();
        }
        return  redirect()->back()->with('error', 'تم الحذف');
    }


    public function carServices($id)
    {
    }
    public function destroyService(Request $request)
    {
        if (is_numeric($request->id)) {
            carService::where('id', $request->id)->delete();
        }
        return  redirect()->back()->with('error', 'تم الحذف');
    }
}
