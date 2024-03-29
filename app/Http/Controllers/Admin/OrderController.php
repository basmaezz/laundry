<?php

namespace App\Http\Controllers\Admin;

use App\Enums\orderStatusEnum;
use App\Exports\delegateOrdersExport;
use App\Exports\ordersExport;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\Delegate;
use App\Models\DeliveryHistory;
use App\Models\OrderDetails;
use App\Models\OrderStatusHistory;
use App\Models\OrderTable;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if(Gate::denies('Orders.index')){
            abort(403);
        };

        if(request()->ajax()) {
            $data = OrderTable::where('order_type',1)->orderBy('id', 'DESC')->get();


            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id;
                })-> addColumn('user',function ($row){
                    return $row->userTrashed->name;
                })->addColumn('deliveryType',function ($row){
                    return $row->delivery_type=='1' ? 'استلام بواسطه العميل':'استلام بواسطه المندوب';
                })->addColumn('orderType',function ($row){
                    return $row->urgent=='1'?'<button type="button" class="btn btn-outline-danger" disabled>مستعجل</button>':'<button type="button" class="btn btn-outline-primary" disabled>عادى</button>';
                })->addColumn('finished',function ($row){
                    if($row->is_finished){
                        return minutesToHumanReadable($row->histories->sum('spend_time') ?? 0);
                    }else{
                        if($row->created_at){
                            return  '<time class="timeago" datetime="'.$row->created_at->toISOString().'">'. $row->created_at->toDateString() .'</time>';
                        }else{
                            return '' ;
                        }
                    }
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('commission', function ($row) {
                    return $row->total_commission;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('city', function ($row) {
                    return $row->userTrashed->citiesTrashed->name_ar;
                })->addColumn('createdAt', function ($row) {

                    return $row->created_at ? $row->created_at->format('d-m-Y'):'';
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','user_id','category','user','deliveryType','orderType','laundryProfit','appProfit','delivery','commission','finished','city','createdAt'])
                ->make(true);
        }
        return  view('dashboard.Orders.index');
    }

    public function export()
    {
        return Excel::download(new ordersExport, 'orders.xlsx');
        return redirect()->back();
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

        $deliveryReceive=DeliveryHistory::with('appUserTrashed')->where('order_id',$id)->where('direction','FromLaundry')->first();
        $deliveryDelivered=DeliveryHistory::with('appUserTrashed')->where('order_id',$id)->where('direction','ToLaundry')->first();
        if($order->order_type==1){
            $orderDetails=orderDetails::with(['productTrashed','productService'])->where('order_table_id',$id)->get();
            return  view('dashboard.Orders.view',compact(['order','orderDetails','deliveryReceive','deliveryDelivered']));
        }elseif ($order->order_type==3){
            $orderDetails=orderDetails::with(['carpetCategoryTrashed'])->where('order_table_id',$id)->get();
            return  view('dashboard.Orders.carpetOrderDetails',compact(['order','orderDetails','deliveryReceive','deliveryDelivered']));

        }

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
            $data = OrderTable::where("status_id",orderStatusEnum::WaitingForDelivery)->orderBy('id', 'DESC')->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id ;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name ;
                })->addColumn('delegate',function ($row){
                    return $row->delegateTrashed->appUserTrashed->name ??'';
                })->addColumn('orderType',function ($row){
                    return $row->urgent=='1'?'<button type="button" class="btn btn-outline-danger" disabled>مستعجل</button>':'<button type="button" class="btn btn-outline-primary" disabled>عادى</button>';

                })->addColumn('duration',function ($row){
                    $current = $row->histories->where('status_id',orderStatusEnum::WaitingForDelivery)->first();
                    $next = $row->histories->where('status_id',orderStatusEnum::AcceptedByDelivery)->first();
                    if($next){
                        return  minutesToHumanReadable($current->spend_time);
                    }else{
                        return '<time class="timeago" datetime="'.$current->created_at->toISOString().'"> ' . $current->created_at->toDateString() .' </time>';
                    }
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('commission', function ($row) {
                    return $row->total_commission;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('city', function ($row) {
                    return $row->userTrashed->citiesTrashed->name_ar;
                })->addColumn('created_at',function ($row){
                    return $row->created_at->format('d/m/Y') ;
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','category','user_id','user','orderType','laundryProfit','appProfit','commission','delivery','duration','city','created_at'])
                ->make(true);
        }

        return  view('dashboard.Orders.pendingDeliveryAcceptance');
    }
    public function  DeliveryOnWay(){

        if(request()->ajax()) {
            $data = OrderTable::where("status_id",orderStatusEnum::AcceptedByDelivery)->with('delegateTrashed.appUserTrashed')->orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id ;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name ;
                })->addColumn('delegate_id',function ($row){
                    return $row->delegateTrashed->appUserTrashed->id ??'';
                })->addColumn('delegate',function ($row){
                    return $row->delegateTrashed->appUserTrashed->name ??'';
                })->addColumn('orderType',function ($row){
                    return $row->urgent=='1'?'<button type="button" class="btn btn-outline-danger" disabled>مستعجل</button>':'<button type="button" class="btn btn-outline-primary" disabled>عادى</button>';

                })->addColumn('duration',function ($row){
                    $current = $row->histories->where('status_id',orderStatusEnum::AcceptedByDelivery)->first();
                    $next = $row->histories->where('status_id',orderStatusEnum::WayToLaundry)->first();
                    if($next){
                        return  minutesToHumanReadable($current->spend_time);
                    }else{
                        if($row->created_at){
                            return '<time class="timeago" datetime="'.$current->created_at->toISOString().'"> ' . $current->created_at->toDateString() .' </time>';
                        }
                        return '';
                    }
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('commission', function ($row) {
                    return $row->total_commission;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('city', function ($row) {
                    return $row->userTrashed->citiesTrashed->name_ar;
                })->addColumn('regionName', function ($row) {
                    return $row->userTrashed->region_name;
                })->addColumn('created_at',function ($row){
                    return $row->created_at !=null ?$row->created_at->format('d/m/Y'):'' ;
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','category','user','user_id','delegate_id','delegate','duration','orderType','city','regionName','laundryProfit','appProfit','commission','delivery','created_at'])
                ->make(true);
        }
        return  view('dashboard.Orders.DeliveryOnWay');
    }
    public function  WayToLaundry(){

        if(request()->ajax()) {
            $data = OrderTable::where("status_id",orderStatusEnum::WayToLaundry)->orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name ;
                })->addColumn('delegate',function ($row){
                    return $row->delegateTrashed->appUserTrashed->name ??'';
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id ;
                })->addColumn('delegate_id',function ($row){
                    return $row->delegateTrashed->appUserTrashed->id ??'';
                })->
                addColumn('orderType',function ($row){
                    return $row->urgent=='1'?'<button type="button" class="btn btn-outline-danger" disabled>مستعجل</button>':'<button type="button" class="btn btn-outline-primary" disabled>عادى</button>';

                })->addColumn('deliveryType',function ($row){
                    return $row->delivery_type=='1' ? 'استلام بواسطه العميل':'استلام بواسطه المندوب';
                })->addColumn('duration',function ($row){
                    $current = $row->histories->where('status_id',orderStatusEnum::WayToLaundry)->first();
                    $next = $row->histories->where('status_id',orderStatusEnum::DeliveredToLaundry)->first();
                    if($next){
                        return  minutesToHumanReadable($current->spend_time);
                    }else{
                        return '<time class="timeago" datetime="'.$current->created_at->toISOString().'"> ' . $current->created_at->toDateString() .' </time>';
                    }
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('commission', function ($row) {
                    return $row->total_commission;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('city', function ($row) {
                    return $row->userTrashed->citiesTrashed->name_ar;
                })->addColumn('created_at',function ($row){
                    return $row->created_at->format('d/m/Y') ;
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','category','user_id','delegate_id','user','delegate','orderType','duration','laundryProfit','appProfit','commission','delivery','city','created_at'])
                ->make(true);
        }
        return  view('dashboard.Orders.WayToLaundry');
    }
    public function  DeliveredToLaundry(){

        if(request()->ajax()) {
            $data = OrderTable::with(['histories','delegateTrashed.appUserTrashed'])->where("status_id",orderStatusEnum::DeliveredToLaundry)->orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name ;
                })->addColumn('delegate',function ($row){
                    return $row->delegateTrashed->appUserTrashed->name ??'';
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id ;
                })->addColumn('delegate_id',function ($row){
                    return $row->delegateTrashed->appUserTrashed->id ??'';
                })->addColumn('duration',function ($row){
                    $current = $row->histories->where('status_id',orderStatusEnum::DeliveredToLaundry)->first();
                    $next = $row->histories->where('status_id',orderStatusEnum::ClothesReadyForDelivery)->first();
                    if($next){
                        return  minutesToHumanReadable($current->spend_time);
                    }else{
                        return '<time class="timeago" datetime="'.$current->created_at->toISOString().'"> ' . $current->created_at->toDateString() .' </time>';
                    }
                })->addColumn('orderType',function ($row){
                    return $row->urgent=='1'?'<button type="button" class="btn btn-outline-danger" disabled>مستعجل</button>':'<button type="button" class="btn btn-outline-primary" disabled>عادى</button>';

                })->addColumn('created_at',function ($row){
                    return $row->created_at->format('d/m/Y') ;
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('commission', function ($row) {
                    return $row->total_commission;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('city', function ($row) {
                    return $row->userTrashed->citiesTrashed->name_ar;
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','category','user_id','delegate_id','user','delegate','duration','created_at','orderType','laundryProfit','appProfit','commission','delivery','city'])
                ->make(true);
        }

        return  view('dashboard.Orders.DeliveredToLaundry');
    }
    public function  readyPickUp(){

        if(request()->ajax()) {
            $data = OrderTable::with(['subCategoriesTrashed','userTrashed','address','delegateTrashed.appUserTrashed'])
                ->where("status_id",orderStatusEnum::ClothesReadyForDelivery)
                ->orderBy('id', 'DESC')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name ;
                })->addColumn('delegate',function ($row){
                    return $row->delegateTrashed->appUserTrashed->name ??'';
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id ;
                })->addColumn('delegate_id',function ($row){
                    return $row->delegateTrashed->appUserTrashed->id ??'';
                })->addColumn('duration',function ($row){
                    $current = $row->histories->where('status_id',orderStatusEnum::ClothesReadyForDelivery)->first();
                    $next = $row->histories->where('status_id',orderStatusEnum::AcceptedByDeliveryToYou)->first();
                    if($next){
                        return  minutesToHumanReadable($current->spend_time);
                    }else{
                        return '<time class="timeago" datetime="'.$current->created_at->toISOString().'"> ' . $current->created_at->toDateString() .' </time>';
                    }
                })->

                addColumn('orderType',function ($row){
                    return $row->urgent=='1'?'<button type="button" class="btn btn-outline-danger" disabled>مستعجل</button>':'<button type="button" class="btn btn-outline-primary" disabled>عادى</button>';

                })->addColumn('created_at',function ($row){
                    return $row->created_at->format('d/m/Y') ;
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('commission', function ($row) {
                    return $row->total_commission;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('city', function ($row) {
                    return $row->userTrashed->citiesTrashed->name_ar;
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','category','user','user_id','delegate_id','delegate','duration','created_at','laundryProfit','appProfit','orderType','commission','delivery','city'])
                ->make(true);
        }
        return  view('dashboard.Orders.ordersPickUp');
    }
    public function  WaitingForDeliveryToReceiveOrder(){

        if(request()->ajax()) {
            $data = OrderTable::where("status_id",orderStatusEnum::WaitingForDeliveryToReceiveOrder)->orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name;
                })->addColumn('deliveryType',function ($row){
                    return $row->delivery_type=='1' ? 'استلام بواسطه العميل':'استلام بواسطه المندوب';
                })->addColumn('duration',function ($row){
                    $current = $row->histories->where('status_id',orderStatusEnum::WaitingForDeliveryToReceiveOrder)->first();
                    $next = $row->histories->where('status_id',orderStatusEnum::AcceptedByDeliveryToYou)->first();
                    if($next){
                        return  minutesToHumanReadable($current->spend_time);
                    }else{
                        return '<time class="timeago" datetime="'.$current->created_at->toISOString().'"> ' . $current->created_at->toDateString() .' </time>';
                    }
                })->addColumn('orderType',function ($row){
                    return $row->urgent=='1'?'<button type="button" class="btn btn-outline-danger" disabled>مستعجل</button>':'<button type="button" class="btn btn-outline-primary" disabled>عادى</button>';

                })->addColumn('created_at',function ($row){
                    return $row->created_at->format('d/m/Y') ;
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('commission', function ($row) {
                    return $row->total_commission;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('city', function ($row) {
                    return $row->userTrashed->citiesTrashed->name_ar;
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['category','user_id','user','deliveryType','duration','created_at','action','laundryProfit','orderType','appProfit','commission','delivery','city'])
                ->make(true);
        }
        return  view('dashboard.Orders.WaitingForDeliveryToReceiveOrder');
    }
    public function  DeliveryOnTheWayToYou(){

        if(request()->ajax()) {
            $data = OrderTable::where("status_id",orderStatusEnum::AcceptedByDeliveryToYou)->with('delegateTrashed.appUserTrashed')->orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id ;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name ;
                })->addColumn('delegate_id',function ($row){
                    return $row->delegateTrashed->appUserTrashed->name ??'';
                })->addColumn('delegate',function ($row){
                    return $row->delegateTrashed->appUserTrashed->name ??'';
                })->addColumn('duration',function ($row){
                    $current = $row->histories->where('status_id',orderStatusEnum::AcceptedByDeliveryToYou)->first();
                    $next = $row->histories->where('status_id',orderStatusEnum::Completed)->first();
                    if($next){
                        return  minutesToHumanReadable($current->spend_time);
                    }else{
                        return '<time class="timeago" datetime="'.$current->created_at->toISOString().'"> ' . $current->created_at->toDateString() .' </time>';
                    }
                })->addColumn('orderType',function ($row){
                    return $row->urgent=='1'?'<button type="button" class="btn btn-outline-danger" disabled>مستعجل</button>':'<button type="button" class="btn btn-outline-primary" disabled>عادى</button>';

                })->addColumn('created_at',function ($row){
                    return $row->created_at->format('d/m/Y') ;
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('commission', function ($row) {
                    return $row->total_commission;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('city', function ($row) {
                    return $row->userTrashed->citiesTrashed->name_ar;
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','category','user_id','user','delegate_id','delegate','duration','created_at','laundryProfit','appProfit','commission','orderType','delivery','city'])
                ->make(true);
        }
        return  view('dashboard.Orders.DeliveryOnTheWayToYou');
    }
    public function  completed(){

        if(request()->ajax()) {
            $data = OrderTable::where("status_id",orderStatusEnum::Completed)->with('delegateTrashed.appUserTrashed')->orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name ;
                })->addColumn('delegate',function ($row){
                    return $row->delegateTrashed->appUserTrashed->name ??'';
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id ;
                })->addColumn('delegate_id',function ($row){
                    return $row->delegateTrashed->appUserTrashed->id ??'';
                })->addColumn('deliveryType',function ($row){
                    return $row->delivery_type=='1' ? 'استلام بواسطه العميل':'استلام بواسطه المندوب';
                })->addColumn('city', function ($row) {
                    return $row->userTrashed->citiesTrashed->name_ar;
                })->addColumn('year', function ($row) {
                    return $row->created_at->year;
                })->addColumn('month', function ($row) {
                    return $row->created_at->month;
                })->addColumn('day', function ($row) {
                    return $row->created_at->day;
                })->addColumn('action', function ($row) {
                    $btns='<div class="dropdown">
                                <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>

                                </div>
                            </div> ';
                    return $btns;
                })
                ->rawColumns(['action','category','user','user_id','delegate_id','delegate','deliveryType','city','year','month','day'])
                ->make(true);
        }

        return  view('dashboard.Orders.completed');


    }
    public function  canceled(){

        if(request()->ajax()) {
            $data = OrderTable::where("status_id",orderStatusEnum::Cancel)->with('delegateTrashed.appUserTrashed')->orderBy('id', 'DESC')->get();
            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user',function ($row){
                    return $row->userTrashed->name;
                })->addColumn('delegate',function ($row){
                    return $row->delegateTrashed->appUserTrashed->name ??'';
                })->addColumn('duration',function ($row){
                    return minutesToHumanReadable($row->histories->sum('spend_time') ?? 0);
                })->addColumn('created_at',function ($row){
                    return $row->created_at->format('d/m/Y');
                })->addColumn('updated_at',function ($row){
                    return $row->updated_at->format('d/m/Y');
                })
                ->addColumn('action', function ($row) {
                    $btns='<a href="' . Route('Order.show', $row->id) . '"  class="edit btn btn-success btn-sm customOrder"style="max-height:20px;max-width:37px" >التفاصيل</a> ';
                    return $btns;
                })
                ->rawColumns(['action','category','user_id','user','delegate','duration','created_at','updated_at'])
                ->make(true);
        }


        return  view('dashboard.Orders.completed');
    }


    public function delegateOrders($id)
    {
        $delegate=Delegate::withTrashed()->find($id);
        $delivery_id=$delegate->app_user_id;
        $orderCount= DeliveryHistory::where('user_id',$delivery_id)->count();

        if(request()->ajax()) {
            $delegate=Delegate::withTrashed()->find($id);
            $data = DeliveryHistory::with(['order','order.userTrashed'])->where('user_id',$delivery_id)->orderBy('id', 'DESC')->get();

            return   Datatables::of($data)
                ->addColumn('subCategory', function ($row) {
                    $order=orderTable::with('subCategoriesTrashed')->where('id',$row->order_id)->first();
                    return $order->subCategoriesTrashed->name_ar;
                })->addColumn('customer_id', function ($row) {
                    $order=orderTable::with('userTrashed')->where('id',$row->order_id)->first();
                    return $order->userTrashed->id;
                })->addColumn('customer_name', function ($row) {
                    $order=orderTable::with('userTrashed')->where('id',$row->order_id)->first();
                    return $order->userTrashed->name;
                })->addColumn('createdAt', function ($row) {
                    return $row->created_at ? $row->created_at->format('d-m-Y'):'';
                })   ->addColumn('delivery', function ($row) {
                    $order=orderTable::with('subCategoriesTrashed')->where('id',$row->order_id)->first();
                    return $order->subCategoriesTrashed->price .' '.'ريال';
                })->addColumn('action', function ($row) {
                    return '<div class="dropdown"><button type="button" class="edit btn btn-info" data-toggle="dropdown">المزيد</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>
                                </div>
                            </div>';
                })
                ->rawColumns(['subCategory','customer_id','customer_name','createdAt','action','delivery'])
                ->make(true);
        }
        return  view('dashboard.Orders.delegateOrders',compact(['id','delivery_id','orderCount']));
    }
    public function cancelOrder(Request $request)
    {

        if (is_numeric($request->id)) {
            OrderTable::find($request->id)->update([
                'status_id' => '10',
                'status' =>'الطلب ملغى',
            ]);
        }

        return redirect()->back();

    }

    public function exportDelegateOrders(Request $request)
    {
        return Excel::download(new delegateOrdersExport($request->id), 'delegateOrders.xlsx');
        return redirect()->back();
    }

    public function carpetOrders()
    {

        if(Gate::denies('carpetOrders.index')){
            abort(403);
        };

        if(request()->ajax()) {
            $data = OrderTable::where('order_type',3)->orderBy('id', 'DESC')->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id;
                })-> addColumn('user',function ($row){
                    return $row->userTrashed->name;
                })->addColumn('finished',function ($row){
                    if($row->is_finished){
                        return minutesToHumanReadable($row->histories->sum('spend_time') ?? 0);
                    }else{
                        if($row->created_at){
                            return  '<time class="timeago" datetime="'.$row->created_at->toISOString().'">'. $row->created_at->toDateString() .'</time>';
                        }else{
                            return '' ;
                        }
                    }
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('createdAt', function ($row) {

                    return $row->created_at ? $row->created_at->format('d-m-Y'):'';
                })->addColumn('ReceiveTime', function ($row) {
                    $start=$row->carpetLaundryReceiveTime->start_from??'';
                    $end=$row->carpetLaundryReceiveTime->end_to??'';
                    return $start.'<br>'. $end;
                })->addColumn('DeliveryTime', function ($row) {
                    $start=$row->carpetLaundryDeliveryTime->start_from??'';
                    $end=$row->carpetLaundryDeliveryTime->end_to??'';
                    return $start.'<br>'. $end;
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','user_id','category','user','ReceiveTime','DeliveryTime','deliveryType','orderType','laundryProfit','appProfit','delivery','finished','createdAt'])
                ->make(true);
        }
        return  view('dashboard.Orders.carpetOrders');


    }
    public function  pendingCarpetDeliveryAcceptance()
    {
        if(request()->ajax()) {
            $data = OrderTable::where('order_type',3)->where("status_id",orderStatusEnum::WaitingForDelivery)->orderBy('id', 'DESC')->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id;
                })-> addColumn('user',function ($row){
                    return $row->userTrashed->name;
                })->addColumn('finished',function ($row){
                    if($row->is_finished){
                        return minutesToHumanReadable($row->histories->sum('spend_time') ?? 0);
                    }else{
                        if($row->created_at){
                            return  '<time class="timeago" datetime="'.$row->created_at->toISOString().'">'. $row->created_at->toDateString() .'</time>';
                        }else{
                            return '' ;
                        }
                    }
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('createdAt', function ($row) {

                    return $row->created_at ? $row->created_at->format('d-m-Y'):'';
                })->addColumn('ReceiveTime', function ($row) {
                    $start=$row->carpetLaundryReceiveTime->start_from;
                    $end=$row->carpetLaundryReceiveTime->end_to;
                    return $start.'<br>'. $end;
                })->addColumn('DeliveryTime', function ($row) {
                    $start=$row->carpetLaundryDeliveryTime->start_from;
                    $end=$row->carpetLaundryDeliveryTime->end_to;
                    return $start.'<br>'. $end;
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','user_id','category','user','ReceiveTime','DeliveryTime','deliveryType','orderType','laundryProfit','appProfit','delivery','finished','createdAt'])
                ->make(true);
        }

        return  view('dashboard.Orders.pendingCarpetDeliveryAcceptance');
    }
    public function  carpetDeliveryOnWay()
    {
        if(request()->ajax()) {
            $data = OrderTable::where('order_type',3)->where("status_id",orderStatusEnum::AcceptedByDelivery)->orderBy('id', 'DESC')->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id;
                })-> addColumn('user',function ($row){
                    return $row->userTrashed->name;
                })->
                addColumn('status',function ($row){
                    return 'المندوب فى الطريق للعميل';
                })->

                addColumn('finished',function ($row){
                    if($row->is_finished){
                        return minutesToHumanReadable($row->histories->sum('spend_time') ?? 0);
                    }else{
                        if($row->created_at){
                            return  '<time class="timeago" datetime="'.$row->created_at->toISOString().'">'. $row->created_at->toDateString() .'</time>';
                        }else{
                            return '' ;
                        }
                    }
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('createdAt', function ($row) {

                    return $row->created_at ? $row->created_at->format('d-m-Y'):'';
                })->addColumn('ReceiveTime', function ($row) {
                    $start=$row->carpetLaundryReceiveTime->start_from;
                    $end=$row->carpetLaundryReceiveTime->end_to;
                    return $start.'<br>'. $end;
                })->addColumn('DeliveryTime', function ($row) {
                    $start=$row->carpetLaundryDeliveryTime->start_from;
                    $end=$row->carpetLaundryDeliveryTime->end_to;
                    return $start.'<br>'. $end;
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','user_id','category','user','status','ReceiveTime','DeliveryTime','deliveryType','orderType','laundryProfit','appProfit','delivery','finished','createdAt'])
                ->make(true);
        }

        return  view('dashboard.Orders.carpetDeliveryOnWay');
    }
    public function  carpetDeliveryWayToLaundry()
    {
        if(request()->ajax()) {
            $data = OrderTable::with(['histories','delegateTrashed.appUserTrashed'])->where('order_type',3)->where("status_id",orderStatusEnum::WayToLaundry)->orderBy('id', 'DESC')->get();


            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id;
                })-> addColumn('user',function ($row){
                    return $row->userTrashed->name;
                })->addColumn('finished',function ($row){
                    if($row->is_finished){
                        return minutesToHumanReadable($row->histories->sum('spend_time') ?? 0);
                    }else{
                        if($row->created_at){
                            return  '<time class="timeago" datetime="'.$row->created_at->toISOString().'">'. $row->created_at->toDateString() .'</time>';
                        }else{
                            return '' ;
                        }
                    }
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('createdAt', function ($row) {

                    return $row->created_at ? $row->created_at->format('d-m-Y'):'';
                })->addColumn('ReceiveTime', function ($row) {
                    $start=$row->carpetLaundryReceiveTime->start_from;
                    $end=$row->carpetLaundryReceiveTime->end_to;
                    return $start.'<br>'. $end;
                })->addColumn('DeliveryTime', function ($row) {
                    $start=$row->carpetLaundryDeliveryTime->start_from;
                    $end=$row->carpetLaundryDeliveryTime->end_to;
                    return $start.'<br>'. $end;
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','user_id','category','user','ReceiveTime','DeliveryTime','deliveryType','orderType','laundryProfit','appProfit','delivery','finished','createdAt'])
                ->make(true);
        }

        return  view('dashboard.Orders.carpetDeliveryWayToLaundry');
    }
    public function  carpetsDeliveredToLaundry()
    {
        if(request()->ajax()) {
            $data = OrderTable::where('order_type',3)->where('order_type',3)->where("status_id",orderStatusEnum::DeliveredToLaundry)->orderBy('id', 'DESC')->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id;
                })-> addColumn('user',function ($row){
                    return $row->userTrashed->name;
                })->addColumn('finished',function ($row){
                    if($row->is_finished){
                        return minutesToHumanReadable($row->histories->sum('spend_time') ?? 0);
                    }else{
                        if($row->created_at){
                            return  '<time class="timeago" datetime="'.$row->created_at->toISOString().'">'. $row->created_at->toDateString() .'</time>';
                        }else{
                            return '' ;
                        }
                    }
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('createdAt', function ($row) {

                    return $row->created_at ? $row->created_at->format('d-m-Y'):'';
                })->addColumn('ReceiveTime', function ($row) {
                    $start=$row->carpetLaundryReceiveTime->start_from??'';
                    $end=$row->carpetLaundryReceiveTime->end_to??'';
                    return $start.'<br>'. $end;
                })->addColumn('DeliveryTime', function ($row) {
                    $start=$row->carpetLaundryDeliveryTime->start_from??'';
                    $end=$row->carpetLaundryDeliveryTime->end_to??'';
                    return $start.'<br>'. $end;
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '
                                <a href="' . Route('Order.completeOrder', $row->id) . '" class="edit btn btn-success">   انهاء الطلب </a>

                            <div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','user_id','category','user','ReceiveTime','DeliveryTime','deliveryType','orderType','laundryProfit','appProfit','delivery','finished','createdAt'])
                ->make(true);
        }

        return  view('dashboard.Orders.carpetsDeliveredToLaundry');
    }
    public function  WaitingForCarpetDeliveryToReceiveOrder()
    {
        if(request()->ajax()) {
            $data = OrderTable::where('order_type',3)->where("status_id",orderStatusEnum::ClothesReadyForDelivery)->orderBy('id', 'DESC')->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id;
                })-> addColumn('user',function ($row){
                    return $row->userTrashed->name;
                })->addColumn('status',function ($row){
                    return 'فى انتظار موافقه المندوب';
                })->addColumn('finished',function ($row){
                    if($row->is_finished){
                        return minutesToHumanReadable($row->histories->sum('spend_time') ?? 0);
                    }else{
                        if($row->created_at){
                            return  '<time class="timeago" datetime="'.$row->created_at->toISOString().'">'. $row->created_at->toDateString() .'</time>';
                        }else{
                            return '' ;
                        }
                    }
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('createdAt', function ($row) {

                    return $row->created_at ? $row->created_at->format('d-m-Y'):'';
                })->addColumn('ReceiveTime', function ($row) {
                    $start=$row->carpetLaundryReceiveTime->start_from??'';
                    $end=$row->carpetLaundryReceiveTime->end_to??'';
                    return $start.'<br>'. $end;
                })->addColumn('DeliveryTime', function ($row) {
                    $start=$row->carpetLaundryDeliveryTime->start_from??'';
                    $end=$row->carpetLaundryDeliveryTime->end_to??'';
                    return $start.'<br>'. $end;
                })
                ->addColumn('action', function ($row) {
                    $cancelBtn='<a class="dropdown-item" id="deleteBtn" data-id="'.$row->id.'" data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>الغاء الطلب</span>
                                    </a>';
                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                      '. $cancelBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','user_id','category','user','status','ReceiveTime','DeliveryTime','deliveryType','orderType','laundryProfit','appProfit','delivery','finished','createdAt'])
                ->make(true);
        }
        return  view('dashboard.Orders.WaitingForCarpetDeliveryToReceiveOrder');
    }
    public function  carpetDeliveryOnTheWayToYou()
    {

        if(request()->ajax()) {
            $data = OrderTable::where('order_type',3)->where("status_id",orderStatusEnum::AcceptedByDeliveryToYou)->with('delegateTrashed.appUserTrashed')->orderBy('id', 'DESC')->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id;
                })-> addColumn('user',function ($row){
                    return $row->userTrashed->name;
                })->addColumn('finished',function ($row){
                    if($row->is_finished){
                        return minutesToHumanReadable($row->histories->sum('spend_time') ?? 0);
                    }else{
                        if($row->created_at){
                            return  '<time class="timeago" datetime="'.$row->created_at->toISOString().'">'. $row->created_at->toDateString() .'</time>';
                        }else{
                            return '' ;
                        }
                    }
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('createdAt', function ($row) {

                    return $row->created_at ? $row->created_at->format('d-m-Y'):'';
                })->addColumn('ReceiveTime', function ($row) {
                    $start=$row->carpetLaundryReceiveTime->start_from;
                    $end=$row->carpetLaundryReceiveTime->end_to;
                    return $start.'<br>'. $end;
                })->addColumn('DeliveryTime', function ($row) {
                    $start=$row->carpetLaundryDeliveryTime->start_from;
                    $end=$row->carpetLaundryDeliveryTime->end_to;
                    return $start.'<br>'. $end;
                })
                ->addColumn('action', function ($row) {

                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','user_id','category','user','ReceiveTime','DeliveryTime','deliveryType','orderType','laundryProfit','appProfit','delivery','finished','createdAt'])
                ->make(true);
        }

        return  view('dashboard.Orders.carpetDeliveryOnTheWayToYou');
    }
    public function  carpetOrdersCompleted(){
        $data = OrderTable::where('order_type',3)->where("status_id",orderStatusEnum::Completed)->with('delegateTrashed.appUserTrashed')->orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            $data = OrderTable::where('order_type',3)->where("status_id",orderStatusEnum::Completed)->with('delegateTrashed.appUserTrashed')->orderBy('id', 'DESC')->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){
                    return $row->subCategoriesTrashed->name_ar;
                })->addColumn('user_id',function ($row){
                    return $row->userTrashed->id;
                })-> addColumn('user',function ($row){
                    return $row->userTrashed->name;
                })->addColumn('finished',function ($row){
                    if($row->is_finished){
                        return minutesToHumanReadable($row->histories->sum('spend_time') ?? 0);
                    }else{
                        if($row->created_at){
                            return  '<time class="timeago" datetime="'.$row->created_at->toISOString().'">'. $row->created_at->toDateString() .'</time>';
                        }else{
                            return '' ;
                        }
                    }
                })->addColumn('laundryProfit', function ($row) {
                    return $row->sum_price-($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('appProfit', function ($row) {
                    return ($row->sum_price *$row->subCategoriesTrashed->percentage)/100;
                })->addColumn('delivery', function ($row) {
                    return $row->subCategoriesTrashed->price;
                })->addColumn('createdAt', function ($row) {

                    return $row->created_at ? $row->created_at->format('d-m-Y'):'';
                })->addColumn('ReceiveTime', function ($row) {
                    $start=$row->carpetLaundryReceiveTime->start_from;
                    $end=$row->carpetLaundryReceiveTime->end_to;
                    return $start.'<br>'. $end;
                })->addColumn('DeliveryTime', function ($row) {
                    $start=$row->carpetLaundryDeliveryTime->start_from;
                    $end=$row->carpetLaundryDeliveryTime->end_to;
                    return $start.'<br>'. $end;
                })
                ->addColumn('action', function ($row) {

                    $moreBtn='<a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>';
                    if($row->status_id!=10){
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                      '.$moreBtn.'
                                </div>
                            </div>';
                    }else{
                        return '<div class="dropdown">
                              <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                            '.$moreBtn.'
                             </div>
                            </div>';
                    }
                })
                ->rawColumns(['action','user_id','category','user','ReceiveTime','DeliveryTime','deliveryType','orderType','laundryProfit','appProfit','delivery','finished','createdAt'])
                ->make(true);
        }

        return  view('dashboard.Orders.carpetOrderscompleted');
    }

    public function completeOrder($id)
    {
        $order = OrderTable::with('userTrashed')->where('id', $id)->first();
        $settings = SiteSetting::first();
        $distanceDelegate = $settings->distance_delegates ?? config('setting.distance.in_area');
        $order->update([
            'status_id' => orderStatusEnum::WaitingForDeliveryToReceiveOrder,
            'status' => 'تم الأنتهاء من غسيل السجاد',
            'delivery_id'=>null
        ]);

        NotificationController::sendNotification(
            'تم الأنتهاء من غسيل السجاد ✅ ',
            ' سيتم توصيل السجاد لك في وقت التوصيل المحدد طلب رقم #' . $order->id,
            $order->userTrashed,
            $order->id
        );
        $raw = "( 6371 * acos( cos( radians({$order->subCategoriesTrashed->lat}) ) * cos( radians( lat ) )* cos( radians( lng ) - radians({$order->subCategoriesTrashed->lng}) )
            + sin( radians({$order->subCategoriesTrashed->lat}) ) * sin( radians( lat ) ) ) ) <= {$distanceDelegate}";
        $carpetDelegates  = AppUser::query()
            ->available()
            ->delivery()
            ->active()
            ->whereHas('delegates', function ($query) {
                $query->where('deliver_carpet', 1);
            })
            ->whereRaw($raw)
            ->get();


        foreach ($carpetDelegates as $user) {
            NotificationController::sendNotification(
                'New Delivery Request',
                'New Delivery Request Number #' . $order->id,
                $user,
                $order->id
            );
        }

        return redirect()->back();
    }


}

