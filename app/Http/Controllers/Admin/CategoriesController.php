<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public  function index(){
        $categories=Category::All();
        return view('dashboard.Categories.index',compact('categories'));
    }
    public function edit($id)
    {
      $category=Category::find($id);
      return view('dashboard.Categories.edit',compact('category'));
    }

    public function update(Request $request,$id)
    {
       $category= Category::find($id);
        if($request->file('image')){
            $filename = request('image')->getClientOriginalName();
            request()->file('image')->move(public_path() . '/assets/uploads/laundries/' , $filename);
        }
            $category->update([
                'name_ar'=>$request->name_ar,
                'name_en'=>$request->name_en,
                 'image'=>$filename,
            ]);
//        dd($category);
        return redirect()->route('Categories.index');
    }
}
