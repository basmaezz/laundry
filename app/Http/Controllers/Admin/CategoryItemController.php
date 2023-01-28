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

class CategoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

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

        $categoryItems=CategoryItem::find($id)->with(['products.productService','products.productImages'])->get();
        return  view('dashboard.CategoryItems.products',compact('categoryItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    public function update(Request $request, $id)
    {
        $categoryItem=CategoryItem::find($id);
        $categoryItem->update([
           'category_type'=>$request->category_type
        ]);
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
        return redirect()->back()->withErrors(['msg' => 'تم الحذف']);
    }

}
