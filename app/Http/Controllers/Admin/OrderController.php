<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\OrderDetails;
use App\Models\OrderStatusHistory;
use App\Models\OrderTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

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
        if(Gate::denies('Orders.index')){
            abort(403);
        };

        if(request()->ajax()) {
            $data = OrderTable::with(['histories','subCategoriesTrashed','userTrashed','userTrashed.citiesTrashed'])->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name;
                })->addColumn('deliveryType',function ($row){
                    return $row->delivery_type=='1' ? 'استلام بواسطه العميل':'استلام بواسطه المندوب';
                })->addColumn('finished',function ($row){
                    if($row->is_finished){
                        return minutesToHumanReadable($row->histories->sum('spend_time') ?? 0);
                    }else{
                        return  '<time class="timeago" datetime="{{$row->created_at->toISOString()}}">'. $row->created_at->toDateString() .'</time>';
                    }
                })->addColumn('city', function ($row) {
                    return $row->userTrashed->citiesTrashed->name_ar;
                })->addColumn('regionName', function ($row) {
                    return $row->userTrashed->region_name;
                })->addColumn('year', function ($row) {
                    return $row->created_at->year;
                })->addColumn('month', function ($row) {
                    return $row->created_at->month;
                })->addColumn('day', function ($row) {
                    return $row->created_at->day;
                })
                ->addColumn('action', function ($row) {
                    $btns='<a href="' . Route('Order.show', $row->id) . '"  class="edit btn btn-info btn-sm" >التفاصيل</a> ';
                    return $btns;
                })
                ->rawColumns(['action','category','user','deliveryType','finished','city','regionName','year','month','day'])
                ->make(true);
        }
        return  view('dashboard.Orders.index');
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
        $order=OrderTable::with(['subCategoriesTrashed','userTrashed','userTrashed.citiesTrashed','delegateTrashed.appUserTrashed'])->where('id',$id)->first();
        $orderDetails=orderDetails::with(['productTrashed','productService'])->where('order_table_id',$id)->get();
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
        if(request()->ajax()) {
            $data = OrderTable::where("status_id",self::WaitingForDelivery)->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name ;
                })->addColumn('delegate',function ($row){
                    return $row->delegateTrashed->appUserTrashed->name ??'';
                })->addColumn('duration',function ($row){
                    $current = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::WaitingForDelivery)->first();
                    $next = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::AcceptedByDelivery)->first();
                    if($next){
                        return  minutesToHumanReadable($current->spend_time);
                    }else{
                        return '<time class="timeago" datetime="{{$current->created_at->toISOString()}}"> ' . $current->created_at->toDateString() .' </time>';
                    }
                })->addColumn('created_at',function ($row){
                    return $row->created_at->format('d/m/Y') ;
                })->addColumn('action', function ($row) {
                    $btns='<a href="' . Route('Order.show', $row->id) . '"  class="edit btn btn-info btn-sm" >التفاصيل</a> ';
                    return $btns;
                })
                ->rawColumns(['action','category','user','delegate','duration','created_at'])
                ->make(true);
        }

        return  view('dashboard.Orders.pendingDeliveryAcceptance');
    }
    public function  DeliveryOnWay(){

        if(request()->ajax()) {
            $data = OrderTable::where("status_id",self::AcceptedByDelivery)->with('delegateTrashed.appUserTrashed')->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name ;
                })->addColumn('delegate',function ($row){
                    return $row->delegateTrashed->appUserTrashed->name ??'';
                })->addColumn('duration',function ($row){
                    $current = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::WaitingForDelivery)->first();
                    $next = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::AcceptedByDelivery)->first();
                    if($next){
                        return  minutesToHumanReadable($current->spend_time);
                    }else{
                        return '<time class="timeago" datetime="{{$current->created_at->toISOString()}}"> ' . $current->created_at->toDateString() .' </time>';
                    }
                })->addColumn('created_at',function ($row){
                    return $row->created_at->format('d/m/Y') ;
                })->addColumn('action', function ($row) {
                    $btns='<a href="' . Route('Order.show', $row->id) . '"  class="edit btn btn-info btn-sm" >التفاصيل</a> ';
                    return $btns;
                })
                ->rawColumns(['action','category','user','delegate','duration','created_at'])
                ->make(true);
        }
        return  view('dashboard.Orders.DeliveryOnWay');
    }
    public function  WayToLaundry(){

        if(request()->ajax()) {
            $data = OrderTable::where("status_id",self::WayToLaundry)->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name ;
                })->addColumn('delegate',function ($row){
                    return $row->delegateTrashed->appUserTrashed->name ??'';
                })->addColumn('duration',function ($row){
                    $current = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::WaitingForDelivery)->first();
                    $next = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::AcceptedByDelivery)->first();
                    if($next){
                        return  minutesToHumanReadable($current->spend_time);
                    }else{
                        return '<time class="timeago" datetime="{{$current->created_at->toISOString()}}"> ' . $current->created_at->toDateString() .' </time>';
                    }
                })->addColumn('created_at',function ($row){
                    return $row->created_at->format('d/m/Y') ;
                })->addColumn('action', function ($row) {
                    $btns='<a href="' . Route('Order.show', $row->id) . '"  class="edit btn btn-info btn-sm" >التفاصيل</a> ';
                    return $btns;
                })
                ->rawColumns(['action','category','user','delegate','duration','created_at'])
                ->make(true);
        }
        return  view('dashboard.Orders.DeliveryOnWay');
    }
    public function  DeliveredToLaundry(){

        if(request()->ajax()) {
            $data = OrderTable::with(['histories','delegateTrashed.appUserTrashed'])->where("status_id",self::DeliveredToLaundry)->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name ;
                })->addColumn('delegate',function ($row){
                    return $row->delegateTrashed->appUserTrashed->name ??'';
                })->addColumn('duration',function ($row){
                    $current = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::WaitingForDelivery)->first();
                    $next = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::AcceptedByDelivery)->first();
                    if($next){
                        return  minutesToHumanReadable($current->spend_time);
                    }else{
                        return '<time class="timeago" datetime="{{$current->created_at->toISOString()}}"> ' . $current->created_at->toDateString() .' </time>';
                    }
                })->addColumn('created_at',function ($row){
                    return $row->created_at->format('d/m/Y') ;
                })->addColumn('action', function ($row) {
                    $btns='<a href="' . Route('Order.show', $row->id) . '"  class="edit btn btn-info btn-sm" >التفاصيل</a> ';
                    return $btns;
                })
                ->rawColumns(['action','category','user','delegate','duration','created_at'])
                ->make(true);
        }

        return  view('dashboard.Orders.DeliveredToLaundry');
    }
    public function  readyPickUp(){
        $orders=OrderTable::with(['subCategoriesTrashed','userTrashed','address','delegateTrashed.appUserTrashed'])->where("status_id",self::ClothesReadyForDelivery)->get();
        return  view('dashboard.Orders.ordersPickUp',compact('orders'));
    }
    public function  WaitingForDeliveryToReceiveOrder(){
        $orders=OrderTable::where("status_id",self::WaitingForDeliveryToReceiveOrder)->get();
        return  view('dashboard.Orders.WaitingForDeliveryToReceiveOrder',compact('orders'));
    }
    public function  DeliveryOnTheWayToYou(){
        $orders=OrderTable::where("status_id",self::AcceptedByDeliveryToYou)->with('delegateTrashed.appUserTrashed')->get();
        return  view('dashboard.Orders.DeliveryOnTheWayToYou',compact('orders'));
    }
    public function  completed(){
        $orders=OrderTable::with(['subCategoriesTrashed','userTrashed','delegateTrashed.appUserTrashed'])->where("status_id",self::Completed)->get();
        return  view('dashboard.Orders.completed',compact('orders'));
    }
    public function  canceled(){
        $orders=OrderTable::where("status_id",self::Cancel)->with('delegateTrashed.appUserTrashed')->get();
        return  view('dashboard.Orders.completed',compact('orders'));
    }

    public function delegateOrders($id)
    {
        $delegate=Delegate::withTrashed()->find($id);

        $orders=OrderTable::where('delivery_id',$delegate->app_user_id)->get();
        return  view('dashboard.Orders.delegateOrders',compact('orders'));
    }

}
