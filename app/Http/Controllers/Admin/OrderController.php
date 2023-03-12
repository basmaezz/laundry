<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use App\Models\OrderStatusHistory;
use App\Models\OrderTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    const WaitingForDelivery            = 1;
    const AcceptedByDelivery            = 2;
    //const DeliveryOnWay                 = 3;
    const WayToLaundry                  = 3;
    const DeliveredToLaundry            = 4;
    const ClothesReadyForDelivery       = 5;
    const WaitingForDeliveryToReceiveOrder = 6;
    const AcceptedByDeliveryToYou       = 7;
    //const DeliveryOnTheWayToYou         = 9;
    const Completed                     = 8;
    const Cancel                        = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
        {
//            if(Gate::denies('Orders.index')){
//                abort(403);
//            };
           $orders=OrderTable::with(['subCategories','user','user.cities'])->get();
           return  view('dashboard.Orders.index',compact('orders'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=OrderTable::with(['subCategories','user','user.cities'])->where('id',$id)->first();
        $orderDetails=orderDetails::with(['product','productService'])->where('order_table_id',$id)->get();
        return  view('dashboard.Orders.view',compact(['order','orderDetails']));
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
        //
    }
    public function changeStatus(Request $request)
    {
        $order=OrderTable::find($request->id);
        $order->status_id ='0';
        $order->save();
        return response()->json(['success'=>'Status change successfully.']);
    }

    public function  pendingDeliveryAcceptance()
    {
        $orders=OrderTable::where("status_id",self::WaitingForDelivery)->get();
        dd($orders);
        return  view('dashboard.Orders.pendingDeliveryAcceptance',compact('orders'));
    }
    public function  DeliveryOnWay(){
        $orders=OrderTable::where("status_id",self::AcceptedByDelivery)->get();
        dd($orders);
        return  view('dashboard.Orders.DeliveryOnWay',compact('orders'));
    }
    public function  WayToLaundry(){
        $orders=OrderTable::where("status_id",self::WayToLaundry)->get();
        dd($orders);
        return  view('dashboard.Orders.DeliveryOnWay',compact('orders'));
    }
    public function  DeliveredToLaundry(){
        $orders=OrderTable::where("status_id",self::DeliveredToLaundry)->get();
        dd($orders);
        return  view('dashboard.Orders.DeliveryOnWay',compact('orders'));
    }
    public function  readyPickUp(){
        $orders=OrderTable::with(['subCategories','user','address'])->where("status_id",self::ClothesReadyForDelivery)->get();
        dd($orders);
        return  view('dashboard.Orders.ordersPickUp',compact('orders'));
    }
    public function  WaitingForDeliveryToReceiveOrder(){
        $orders=OrderTable::where("status_id",self::WaitingForDeliveryToReceiveOrder)->get();
        dd($orders);
        return  view('dashboard.Orders.WaitingForDeliveryToReceiveOrder',compact('orders'));
    }
    public function  DeliveryOnTheWayToYou(){
        $orders=OrderTable::where("status_id",self::AcceptedByDeliveryToYou)->get();
        dd($orders);
        return  view('dashboard.Orders.DeliveryOnTheWayToYou',compact('orders'));
    }
    public function  completed(){
        $orders=OrderTable::with(['subCategories','user'])->where("status_id",self::Completed)->get();
        return  view('dashboard.Orders.completed',compact('orders'));
    }
    public function  canceled(){
        $orders=OrderTable::where("status_id",self::Cancel)->get();
        dd($orders);
        return  view('dashboard.Orders.completed',compact('orders'));
    }
}
