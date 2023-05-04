<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoriesRequest;
use App\Http\Requests\subCategoryRequest;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\OrderTable;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class subCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if (Gate::denies('subCategory.index')) {
            abort(403);
        };
        if(request()->ajax()) {
            $data = Subcategory::with(['city', 'parentTrashed'])->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $image=$row->image =='null' ? $row->parentTrashed->image :$row->image;
                      return '<img style="width:50px; height:50px" src="'. $image .'" />';
                })->addColumn('city', function ($row) {
                    return $row->city->name_ar??'';
                })->addColumn('parentTrashed', function ($row) {
                    return $row->parentTrashed->name_ar??'';
                })->addColumn('around_clock', function ($row) {
                    return $row->around_clock==1 ?'طوال اليوم' :abs($hours=((int)$row->clock_end)-((int)$row->clock_at)).'ساعه' ;
                })
                ->addColumn('action', function ($row) {
                    $main='<a href="' . Route('laundries.branches', $row->id) . '"  class="edit btn btn-info btn-sm" >الفروع</a>';
                    $branch=' <a href="' . Route('CategoryItems.index', $row->id) . '"  class="edit btn btn-info btn-sm" >الأقسام</a>
                            <a href="' . Route('laundries.edit', $row->id) . '"  class="edit btn btn-success btn-sm" >تعديل</a>
                            <a href="' . Route('laundries.view', $row->id) . '"  class="edit btn btn-info btn-sm" >تفاصيل</a>
                            <a href="' . Route('laundries.orders', $row->id) . '"  class="edit btn btn-success btn-sm" >الطلبات</a>
                            <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal"style="width: 18px;height: 20px;" ><i class="fa fa-trash"></i></a>';
                    return $row->parent_id==Null ? $main .$branch : $branch;
                })
                ->rawColumns(['action', 'city','parentTrashed','around_clock','image'])
                ->make(true);
        }
        return view('dashboard.laundries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::pluck('id', 'name_ar');
        $categories = Category::where('name_ar', 'مغاسل الملابس')->get();
        return view('dashboard.laundries.create', compact(['cities', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(subCategoryRequest $request)
    {
        $subcategory = new Subcategory();
//        dd($request->all());
//        $validated = $request->validate([
//            'category_id' => 'integer',
//            'name_ar' => 'required',
//            'name_en' => 'required',
//            'city_id' => 'required',
//            'location' => 'required', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',
//            'lat' => 'required',
//            'lng' => 'required',
//            'address' => 'required',
//            'price' => 'required',
//            'range' => 'required',
//            'around_clock' => 'required',
//            'clock_at' => 'string',
//            'clock_end' => 'string',
//            'approximate_duration' => 'required',
//            'image' => 'required|image|mimes:jpg,png,jpeg',
//            'name' => 'required',
//            'last_name' => 'required',
//            'email' => '|unique:users|required|regex:/(.+)@(.+)\.(.+)/i',
//            'password' => ['required', 'min:6'],
//            'phone' => 'required|unique:users',
//        ], [
//            'required'  => 'هذا الحقل مطلوب',
//            'name' => 'برجاء ادخال اسم مناسب',
//            'last_name' => 'برجاء ادخال اسم مناسب',
//            'unique' => 'هذا الأسم موجود مسبقا',
//            'email' => 'هذا البريد الالكترونى موجود مسبقا',
//            'phone' => 'هذا الرقم غير صحيح',
//            'location.format' => 'الرابط غير صحيح ',
//        ]);

//        if ($request->around_clock != '') {
//            $subcategory['around_clock'] = $request->around_clock;
//            $subcategory['clock_end'] = '';
//            $subcategory['clock_at'] = '';
//        } else {
//            $subcategory['clock_end'] = $request->clock_end;
//            $subcategory['clock_at'] = $request->clock_at;
//        }
//        if ($request->file('image')) {
//            $filename = request('image')->getClientOriginalName();
//            request()->file('image')->move(public_path() . '/assets/uploads/laundries/logo/', $filename);
//        }
        $subcategory=Subcategory::create($request->validated()+[
            'image'=>uploadFile($request->file('image'), 'laundries/logo/'),
               'around_clock' => $request->around_clock,
                'clock_end' =>$request->clock_end,
                'clock_at' => $request->clock_at,
        ]);

        $user=User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'subCategory_id' => $subcategory->id
        ]);
        $user->save();

        return  redirect()->route('laundries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subCategory = Subcategory::withTrashed()->with(['userTrashed','parentTrashed'])->find($id);

        return view('dashboard.laundries.View', compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCategory = Subcategory::with(['parentTrashed', 'userTrashed'])->find($id);
        $cities = City::all();
        return view('dashboard.laundries.edit', compact(['subCategory', 'cities']));
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
        $subcategory = Subcategory::find($id);
        if ($request->file('image') != '') {
            $filename = request('image')->getClientOriginalName();
            request()->file('image')->move(public_path() . '/assets/uploads/laundries/logo/', $filename);
            $subcategory['image'] = $filename;
        }
        Subcategory::where('id', $id)->update([
            'id' => $id,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'address' => $request->address,
            'city_id' => $request->city_id,
            'price' => $request->price,
            'range' => $request->range,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'approximate_duration' => $request->approximate_duration,
            'around_clock' => $request->around_clock,
            'clock_end' => $request->clock_end,
            'clock_at' => $request->clock_at,
        ]);
        $subcategory->save();

        $user = User::where('subCategory_id', $id)->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            //            'password'=> Hash::make($request->password)
        ]);
        if ($request->password != '') {
            User::where('subCategory_id', $id)->update([
                'password' => Hash::make($request->password)
            ]);
        }
        return  redirect()->route('laundries.index')->with('success', 'تم التعديل');
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
            Subcategory::find($request->id)->delete();
            Subcategory::where('parent_id', $request->id)->delete();
        }
        return  redirect()->back()->with('error', 'تم الحذف');
    }
    public function createAdmin()
    {

        $subCategories = Subcategory::all();

        return view('dashboard.laundries.createAdminLaundry', compact('subCategories'));
    }

    public function storeLaundryAdmin(Request $request)
    {
        if ($request->file('avatar')) {
            $filename = request('avatar')->getClientOriginalName();
            request()->file('avatar')->move(public_path() . '/images/', $filename);
        }
        $user = User::create(
            [
                'subCategory_id' => $request->subCategory_id,
                'approximate_duration' => $request->approximate_duration,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'avatar' => $filename,
            ]

        );
        return redirect()->route('laundries.admins');
    }
    public function adminLaundries()
    {
        $users = User::select("*")->whereNotNull('subCategory_id')->get();
        return view('dashboard.laundries.admins', compact('users'));
    }
    public function updateStats(Request $request)
    {
        $subcategory = Subcategory::find($request->id);
        if ($subcategory->status == '0') {
            $subcategory->status = 1;
        } else {
            $subcategory->status = 0;
        }
        $subcategory->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function branches(Request $request)
    {
     $id=$request->id;
        if(request()->ajax()) {
            $data = Subcategory::with('city')->where('parent_id',$id )->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $image=$row->image =='null' ? $row->parentTrashed->image :$row->image;
                    return '<img style="width:50px; height:50px" src="'. $image .'" />';
                })->addColumn('city', function ($row) {
                    return $row->city->name_ar??'';
                })->addColumn('parentTrashed', function ($row) {
                    return $row->parentTrashed->name_ar??'';
                })->addColumn('around_clock', function ($row) {
                    return $row->around_clock==1 ?'طوال اليوم' :abs($hours=((int)$row->clock_end)-((int)$row->clock_at)).'ساعه' ;
                })
                ->addColumn('action', function ($row) {

                    $btns=' <a href="' . Route('CategoryItems.index', $row->id) . '"  class="edit btn btn-info btn-sm" >الأقسام</a>
                            <a href="' . Route('laundries.edit', $row->id) . '"  class="edit btn btn-success btn-sm" >تعديل</a>
                            <a href="' . Route('laundries.view', $row->id) . '"  class="edit btn btn-info btn-sm" >تفاصيل</a>
                            <a href="' . Route('laundries.orders', $row->id) . '"  class="edit btn btn-success btn-sm" >الطلبات</a>
                            <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal"style="width: 18px;height: 20px;" ><i class="fa fa-trash"></i></a>';
                    return $btns;
                })
                ->rawColumns(['action', 'city','parentTrashed','around_clock','image'])
                ->make(true);
        }

        return view('dashboard.laundries.branches', compact('id'));
    }

    public function createBranch($id)
    {
        $Subcategory = Subcategory::find($id);
        $cities = City::pluck('id', 'name_ar');
        return view('dashboard.laundries.createBranch', compact(['Subcategory', 'cities']));
    }

    public function storeBranch(Request $request)
    {

        $subcategory = new Subcategory();
        $request->validate([
            'parent_id' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'city_id' => 'required',
            'location' => 'required', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',
            'lat' => 'required',
            'lng' => 'required',
            'address' => 'required',
            'price' => 'required',
            'range' => 'required',
            'around_clock' => 'required',
            'clock_at' => 'string',
            'clock_end' => 'string',
            'approximate_duration' => 'required',
            'name' => 'required',
            'last_name' => 'required',
            'email' => '|unique:users|required|regex:/(.+)@(.+)\.(.+)/i',
            'password' => ['required', 'min:6'],
            'phone' => 'required|unique:users',
        ], [
            'required'  => 'هذا الحقل مطلوب',
            'name' => 'برجاء ادخال اسم مناسب',
            'last_name' => 'برجاء ادخال اسم مناسب',
            'unique' => 'هذا الأسم موجود مسبقا',
            'email' => 'هذا البريد الالكترونى موجود مسبقا',
            'phone' => 'هذا الرقم غير صحيح',
            'location.format' => 'الرابط غير صحيح ',
        ]);

        if ($request->around_clock != '') {
            $subcategory['around_clock'] = $request->around_clock;
            $subcategory['clock_end'] = '';
            $subcategory['clock_at'] = '';
        } else {
            $subcategory['clock_end'] = $request->clock_end;
            $subcategory['clock_at'] = $request->clock_at;
        }
        if ($request->file('image') != '') {
            $filename = request('image')->getClientOriginalName();
            request()->file('image')->move(public_path() . '/assets/uploads/laundries/logo/', $filename);
            $subcategory['image'] = $filename;
        }

        $subcategory = Subcategory::create($request->all() + [
            'parent_id' => $request->parent_id
        ]);

        User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'subCategory_id' => $subcategory->id
        ]);
        return  redirect()->route('laundries.index');
    }

    public function editBranch($id)
    {
        $subCategory = Subcategory::with(['parentTrashed', 'userTrashed'])->find($id);
        $cities = City::pluck('id', 'name_ar');
        return view('dashboard.laundries.editBranch', compact(['subCategory', 'cities']));
    }

    public function mainLaundries()
    {
        if(request()->ajax()) {
            $data = Subcategory::whereNull('parent_id')->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $image=$row->image =='null' ? $row->parentTrashed->image :$row->image;
                    return '<img style="width:50px; height:50px" src="'. $image .'" />';
                })->addColumn('city', function ($row) {
                    return $row->city->name_ar??'';
                })->addColumn('around_clock', function ($row) {
                    return $row->around_clock==1 ?'طوال اليوم' :abs($hours=((int)$row->clock_end)-((int)$row->clock_at)).'ساعه' ;
                })
                ->addColumn('action', function ($row) {

                    $btns=' <a href="' . Route('laundries.branches', $row->id) . '"  class="edit btn btn-info btn-sm" >الفروع</a>
                    <a href="' . Route('CategoryItems.index', $row->id) . '"  class="edit btn btn-info btn-sm" >الأقسام</a>
                            <a href="' . Route('laundries.edit', $row->id) . '"  class="edit btn btn-success btn-sm" >تعديل</a>
                            <a href="' . Route('laundries.view', $row->id) . '"  class="edit btn btn-info btn-sm" >تفاصيل</a>
                            <a href="' . Route('laundries.orders', $row->id) . '"  class="edit btn btn-success btn-sm" >الطلبات</a>
                            <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal"style="width: 18px;height: 20px;" ><i class="fa fa-trash"></i></a>';
                    return $btns;
                })
                ->rawColumns(['action', 'city','around_clock','image'])
                ->make(true);
        }
        return view('dashboard.laundries.mainLaundries');
    }
    public function deleteBranch($id)
    {
        Subcategory::find($id)->delete();
        return  redirect()->back()->with('error', 'تم الحذف');
    }

    public function viewTrashedLaundries()
    {


        if(request()->ajax()) {
            $data = Subcategory::with(['city', 'parentTrashed'])->onlyTrashed()->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('city', function ($row) {
                    return $row->city->name_ar??'';
                })
                ->addColumn('action', function ($row) {
                    $btns='
                    <a href="' . Route('laundries.view', $row->id) . '"  class="edit btn btn-info btn-sm" >التفاصيل</a>
                    <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal"style="width: 18px;height: 20px;" ><i class="fa fa-trash"></i></a>
                    ';

                    return $btns;
                })
                ->rawColumns(['action', 'city'])
                ->make(true);
        }
        return view('dashboard.laundries.trashedLaundries');
    }

    public function restoreDeleted(Request $request)
    {
        if (is_numeric($request->id)) {
            Subcategory::withTrashed()->find($request->id)->restore();
            Subcategory::withTrashed()->where('parent_id', $request->id)->restore();
        }
        return redirect()->route('laundries.index')->with('success', 'تم استعاده الحذف');;
    }

    public function getOrders($id)
    {
        $orders = OrderTable::where('laundry_id', $id)->with(['userTrashed', 'delegateTrashed.appUserTrashed'])->get();
        return view('dashboard.laundries.laundryOrders', compact('orders'));
    }
}
