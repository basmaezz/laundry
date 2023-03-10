<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\OrderTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
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
    public function index($id)
    {
        $orders=OrderTable::orders($id)->with('user')->get();
        return  view('customers.backEnd.orders.index',compact('orders'));
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

    public function inProgress($id)
    {
     $orders=OrderTable::orders($id)->where('status_id',4)->get();

     return  view('customers.backEnd.orders.inProgress',compact('orders'));
    }
    public function completed($id)
    {
        $order=OrderTable::find($id);
        $order->update([
            $order['status_id']=self::ClothesReadyForDelivery,
            $order['status']='???? ???????????????? ???? ????????????'
        ]);
        $order->save();
        return redirect()->back();
    }
    public function canceledOrder($id)
    {
        $orders=OrderTable::orders($id)->where('status_id',10)->get();
        return  view('customers.backEnd.orders.canceled',compact('orders'));
    }
    public function finishedOrder($id)
    {
        $orders=OrderTable::orders($id)->where('status_id',5)->get();
        return  view('customers.backEnd.orders.finished',compact('orders'));
    }
}
