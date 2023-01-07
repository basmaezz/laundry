<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryItemRequest;
use App\Models\CategoryItem;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class itemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $categoryItems=CategoryItem::items()->get();
        return view('customers.backEnd.CategoryItems.index',compact('categoryItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
            return view('customers.backEnd.categoryItems.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        CategoryItem::create($request->all());
        return  redirect()->route('Customer.Items.index',$request->subcategory_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        return view('customers.backEnd.categoryItems.edit',compact('categoryItem'));
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
        return redirect()->route('Customer.Items.index',$categoryItem->subcategory_id);
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
