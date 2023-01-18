<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use App\Models\OrderStatusHistory;
use App\Models\OrderTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
        {
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
    public function  pendingDeliveryAcceptance(){
        $orderStatusHistories=OrderStatusHistory::with('order')->where('status_id',1)->get();
        return  view('dashboard.Orders.pendingDeliveryAcceptance',compact(['orderStatusHistories']));
    }
    public function  DeliveryOnWay(){
        $orderStatusHistories=OrderStatusHistory::with('order')->where('status_id',3)->get();
        return  view('dashboard.Orders.DeliveryOnWay',compact(['orderStatusHistories']));
    }
    public function  WayToLaundry(){
        $orderStatusHistories=OrderStatusHistory::with('order')->where('status_id',4)->get();
        return  view('dashboard.Orders.DeliveryOnWay',compact(['orderStatusHistories']));
    }
    public function  DeliveredToLaundry(){
        $orderStatusHistories=OrderStatusHistory::with('order')->where('status_id',5)->get();
        return  view('dashboard.Orders.DeliveryOnWay',compact(['orderStatusHistories']));
    }
    public function  readyPickUp(){
        $orderStatusHistories=OrderStatusHistory::with('order')->where('status_id',6)->get();
        return  view('dashboard.Orders.ordersPickUp',compact(['orderStatusHistories']));
    }
    public function  WaitingForDeliveryToReceiveOrder(){
        $orderStatusHistories=OrderStatusHistory::with('order')->where('status_id',7)->get();
        return  view('dashboard.Orders.WaitingForDeliveryToReceiveOrder',compact(['orderStatusHistories']));
    }
    public function  DeliveryOnTheWayToYou(){
        $orderStatusHistories=OrderStatusHistory::with('order')->where('status_id',9)->get();
        return  view('dashboard.Orders.DeliveryOnTheWayToYou',compact(['orderStatusHistories']));
    }
    public function  completed(){
        $orderStatusHistories=OrderStatusHistory::with('order')->where('status_id',10)->get();
        return  view('dashboard.Orders.completed',compact(['orderStatusHistories']));
    }
}
