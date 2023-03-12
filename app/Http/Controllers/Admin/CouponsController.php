<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\CouponShopCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('Coupons.index')){
            abort(403);
        };
         $coupons=CouponShopCart::all();
         return  view('dashboard.Coupons.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('dashboard.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        CouponShopCart::create($request->validated());
        return redirect()->route('coupons.index')->with('message', 'تمت الاضافه!');

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
        $coupon=CouponShopCart::findorfail($id);
        return view('dashboard.Coupons.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {
        CouponShopCart::where('id',$id)->update($request->validated());
        return redirect()->route('coupons.index')->with('message', 'تم التعديل بنجاح!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CouponShopCart::find($id)->delete();
        return  redirect()->back()->withErrors(['msg' => ' تم الحذف']);
    }

    public function changeStatus($id)
    {
        $coupon=CouponShopCart::findorfail($id);
        $coupon->status=='0' ? $coupon->status='1' :$coupon->status='0';
        $coupon->save();
        return  redirect()->back()->withErrors(['msg' => ' تم تعديل حاله الكوبون']);
    }
}
