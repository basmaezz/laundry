<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;

class subCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories=Subcategory::with('category')->get();
       return view('dashboard.laundries.index',compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('dashboard.laundries.create',compact('categories'));
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
        $subcategory['category_id']=$request->category_id;
        $subcategory['name_ar']=$request->name_ar;
        $subcategory['name_en']=$request->name_en;
        $subcategory['address']=$request->address;
        $subcategory['lat']=$request->lat;
        $subcategory['lng']=$request->lng;
        $subcategory->save();
        return  redirect()->route('laundries.index');

//        $user=new User();
//        $user['name']=$request->name;
//        $user['last_name']=$request->last_name;
//        $user['email']=$request->email;
//        $user['password']=$request->password;
//        $user['phone']=$request->phone;
//        $user['subCategory_id']=$subcategory->id;
//        $user->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subCategory=Subcategory::with('category')->find($id);

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
        //
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
        Subcategory::find($id)->delete();
        return redirect()->back();
    }
    public function createAdmin(){
        $subCategories=Subcategory::all();
        return view('dashboard.laundries.createAdminLaundry',compact('subCategories'));
    }

    public function storeLaundryAdmin(Request $request){
        $user=new User();
        $user['name']=$request->name;
        $user['last_name']=$request->last_name;
        $user['email']=$request->email;
        $user['password']=$request->password;
        $user['phone']=$request->phone;
        $user['subCategory_id']=$request->subCategory_id;

        if($request->file('avatar')){

            $filename = request('avatar')->getClientOriginalName();
            request()->file('avatar')->move(public_path() . '/images/' , $filename);
            $user['avatar']= $filename;
        }
        $user->save();
        return redirect()->route('laundries.admins');
    }
    public function adminLaundries(){
        $users=User::select("*")->whereNotNull('subCategory_id')->get();
        return view('dashboard.laundries.admins',compact('users'));

    }

}
