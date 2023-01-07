<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoriesRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
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

        if ($request->ajax()) {
            $data = Subcategory::all();

            return Datatables::of($data)
                ->addColumn('city',function ($data){
                    return $data->city->name_ar;
                })->addColumn('checkbox', function ($subCategory)  {
                    return'<label class="switch switch-text switch-success">
                                    <input type="checkbox" class="switch-input" id="'.$subCategory->id.'" checked onclick="changeStatus(this.id)">
                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                    <span class="switch-handle"></span>
                                </label>';
                })
                ->addColumn('action', function($subCategory){
                    return '<a href="'.route('CategoryItems.index',$subCategory->id).'" class="edit btn btn-primary btn-sm">الأقسام</a>
                            <a href="'.route('user.edit',$subCategory->id).'" class="edit btn btn-primary btn-sm">تعديل</a>
                    <a href="'.route('laundries.view',$subCategory->id).'" class="edit btn btn-primary btn-sm">التفاصيل</a>
                        <a href="'.route('laundries.destroy',$subCategory->id).'" class="edit btn btn-danger btn-sm">حذف</a>';
                })
                ->rawColumns(['action','checkbox'])
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
        $cities=City::pluck('id','name_ar');
        return view('dashboard.laundries.create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subcategory= new Subcategory();
        if($request->file('avatar')){
            $file= $request->file('avatar');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $url=url('assets/uploads/laundries/logo/');
            $file-> move($url, $filename);
            $subcategory['image']= $filename;
        }
        $subcategory['name_ar']=$request->name_ar;
        $subcategory['name_en']=$request->name_en;
        $subcategory['address']=$request->address;
        $subcategory['city_id']=$request->city_id;
        $subcategory['price']=$request->price;
        $subcategory['around_clock']=$request->around_clock;
        $subcategory['clock_at']=$request->clock_at;
        $subcategory['clock_end']=$request->clock_end;
        $subcategory['category_id']=1;
        $subcategory['status']=1;

        if ((strpos($request->location, 'maps')) !== false) {
            $str = $request->location;

            $x1 = strstr($str, '=');
            $x2 = str_replace('=', '', $x1);
            $x3 = explode(',', $x2);
            array_splice($x3, -1);
            $x4 = implode(',', $x3);
            $subcategory['lat'] = $x3[0];
            $subcategory['lng'] = $x4;

        }
        $subcategory->save();

        User::create([
            'name'=>$request->name,
        'last_name'=>$request->last_name,
        'email'=>$request->email,
        'password'=>$request->password,
        'phone'=>$request->phone,
        'subCategory_id'=>$subcategory->subCategory_id
        ]);

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
        $subCategory=Subcategory::find($id);
        return view('dashboard.laundries.view',compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCategory= Subcategory::find($id);
        return view('dashboard.laundries.edit',compact('subCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        Subcategory::where('id',$id)->update([
            'id'=>$id,
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'address'=>$request->address,
        ]);
        return  redirect()->route('laundries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subcategory::find($id)->delete();
        return redirect()->back();
    }
    public function createAdmin(){
        $subCategories=Subcategory::all();
        return view('dashboard.laundries.createAdminLaundry',compact('subCategories'));
    }

    public function storeLaundryAdmin(Request $request){

        return redirect()->route('laundries.admins');
    }
    public function adminLaundries(){
        $users=User::select("*")->whereNotNull('subCategory_id')->get();
        return view('dashboard.laundries.admins',compact('users'));
    }

    public function updateStats()
    {
        echo('test');
    }

}
