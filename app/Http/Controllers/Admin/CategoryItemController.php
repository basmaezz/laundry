<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryItemRequest;
use App\Models\CategoryItem;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductService;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;

class CategoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(Gate::denies('subCategory.index')){
            abort(403);
        };
        $subCategory=Subcategory::find($id);
        $categoryItems=CategoryItem::where('subcategory_id',$id)->get();

        return view('dashboard.CategoryItems.index',compact(['categoryItems','subCategory']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $subCategory=Subcategory::find($id);
        return view('dashboard.CategoryItems.create',compact('subCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryItemRequest $request)
    {
        CategoryItem::create( $request->all());
        return  redirect()->route('CategoryItems.index',$request->subcategory_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subCategory=CategoryItem::find($id);
        $products=Product::where('category_item_id',$id)->with(['productService','productImages'])->get();
        return  view('dashboard.CategoryItems.products',compact(['products','id','subCategory']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('categoryItems.index')){
            abort(403);
        };
        $categoryItem=CategoryItem::find($id);
        return view('dashboard.CategoryItems.edit',compact('categoryItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryItemRequest $request, $id)
    {
        $categoryItem=CategoryItem::find($id);
        $request->validate([
            'category_type'=>'required'
        ],[
            'category_type.required'=>'هذا الحقل مطلوب',
        ]);
        $categoryItem->update($request->all());
        return redirect()->route('CategoryItems.index',$categoryItem->subcategory_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryItem::find($id)->delete();
        return  redirect()->back()->with('error', 'تم الحذف');
    }

}
