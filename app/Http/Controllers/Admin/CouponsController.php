<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\CouponShopCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

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

        if(request()->ajax()) {
            $data = CouponShopCart::get();
            return   Datatables::of($data)
                ->addColumn('status',function ($row){
                  return $row->status=='0'?'<span class="badge badge-pill badge-light-danger mr-1">Deactive</span>':'<span class="badge badge-pill badge-light-primary mr-1">Active</span>';
                }) ->addColumn('action', function ($row) {
                    return '
                      <div class="dropdown">
                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . Route('coupon.edit', $row->id) . '">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>Edit</span>
                                    </a>
                                    <a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>Delete</span>
                                    </a>
                                </div>
                            </div>';
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
         return  view('dashboard.Coupons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('dashboard.Coupons.create');
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
        return redirect()->route('coupons.index')->with('success', 'تمت الاضافه!');

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
    public function destroy(Request $request)
    {
        if (is_numeric($request->id)) {
            CouponShopCart::where('id', $request->id)->delete();
        }
        return  redirect()->back()->with('error', 'تم الحذف');
    }

    public function changeStatus($id)
    {
        $coupon=CouponShopCart::findorfail($id);
        $coupon->status=='0' ? $coupon->status='1' :$coupon->status='0';
        $coupon->save();
        return  redirect()->back()->with('message', 'تم التعديل بنجاح!');
    }
}
