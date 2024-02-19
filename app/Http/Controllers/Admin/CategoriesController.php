<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Validator;

class CategoriesController extends Controller
{
    public  function index()
    {
        if(Gate::denies('categories.index')){
            abort(403);
        };
        $categories=Category::All();
        return view('dashboard.Categories.index',compact('categories'));
    }
    public function edit($id)
    {
      $category=Category::find($id);
      return view('dashboard.Categories.edit',compact('category'));
    }

    public function create()
    {
        return view('dashboard.Categories.create');

    }
    public function store(Request $request)
    {
//        $request->validate([
//            'name_ar'=>$request->name_ar,
//            'name_en'=>$request->name_en,
//        ],[
//            'required'=>'اجبارى',
//        ]);

            $filename = request('image')->getClientOriginalName();
            request()->file('image')->move(public_path() . '/assets/uploads/laundries/',$filename);
        Category::create($request->all()+[
                            'image'=>$filename
            ]);
        return  redirect()->route('category.index')->with('success', 'تمت الاضافه');
    }

    public function update(Request $request,$id)
    {

       $category= Category::find($id);

            $category->update([
                'name_ar'=>$request->name_ar,
                'name_en'=>$request->name_en,
            ]);
        if($request->file('image')){
            $filename = request('image')->getClientOriginalName();
            request()->file('image')->move(public_path() . '/assets/uploads/laundries/',$filename);
            $category['image']=$filename;
        }
        $category->save();
        return redirect()->route('Categories.index');
    }
    public function destroy($id)
    {

        Category::find($id)->delete();
        return  redirect()->back()->with('error', 'تم الحذف');
    }
}
