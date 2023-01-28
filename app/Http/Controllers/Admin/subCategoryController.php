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
        $subCategories = Subcategory::with(['city','parent'])->get();
        return view('dashboard.laundries.index',compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities=City::pluck('id','name_ar');
        $categories=Category::where('id',1)->get();
        return view('dashboard.laundries.create',compact(['cities','categories']));
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

        if ((strpos($request->location, 'maps')) !== false) {
            $str = $request->location;
            $x1 = strstr($str, '=');
            $x2 = str_replace('=', '', $x1);
            $x3 = explode(',', $x2);
            array_splice($x3, -1);
            $x4 = implode(',', $x3);
            $subcategory['lat'] = $x3[0];
            $subcategory['lng'] = $x4;
            $subcategory['name_ar'] = $request->name_ar;
            $subcategory['name_en'] = $request->name_en;
            $subcategory['city_id'] = $request->city_id;
            $subcategory['address'] = $request->address;
            $subcategory['price'] = $request->price;
            $subcategory['status'] ='1';
            if($request->around_clock !=''){
             $subcategory['around_clock'] = $request->around_clock;
            $subcategory['clock_end'] = '';
            $subcategory['clock_at'] = '';
            }else{
                $subcategory['clock_end'] = $request->clock_end;
                $subcategory['clock_at'] = $request->clock_at;
            }
            if($request->file('image') !=''){
                $filename = request('image')->getClientOriginalName();
                request()->file('image')->move(public_path() . '/assets/uploads/laundries/logo/' , $filename);
                $subcategory['image']=$filename;
            }
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
        $subCategory=Subcategory::with('user')->find($id);

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
        $subCategory=Subcategory::with('parent')->find($id);
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
        Subcategory::where('parent_id',$id)->delete();
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
public function updateStats(Request $request){
      $subcategory= Subcategory::find($request->id);
      if($subcategory->status =='0'){
          $subcategory->status =1;
      }else{
          $subcategory->status =0;
      }
       $subcategory->save();
       return response()->json(['success'=>'Status change successfully.']);
}

public function branches($id)
{
    $branches= Subcategory::with('city')->where('parent_id',$id)->get();
    return view('dashboard.laundries.branches',compact(['branches','id']));
}

public function createBranch($id)
{
    $Subcategory= Subcategory::find($id);
    $cities=City::pluck('id','name_ar');
    return view('dashboard.laundries.createBranch',compact(['Subcategory','cities']));
}

public function storeBranch(SubCategoriesRequest $request)
{

    $subcategory= new Subcategory();

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
    Subcategory::create($request->validated()+[
            'lat'=>$x3[0],
            'lng'=> $x4,
            'status'=>1,
            'parent_id'=>$request->parent_id,
            'address'=>$request->address,
        ]);

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

public function mainLaundries()
{
    $subCategories = Subcategory::whereNull('parent_id')->get();
    return view('dashboard.laundries.mainLaundries',compact('subCategories'));
}
public function deleteBranch($id)
{
    Subcategory::find($id)->delete();
    return redirect()->back();

}
}
