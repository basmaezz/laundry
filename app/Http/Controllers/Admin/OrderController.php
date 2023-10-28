<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ordersExport;
use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\DeliveryHistory;
use App\Models\OrderDetails;
use App\Models\OrderStatusHistory;
use App\Models\OrderTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if(Gate::denies('Orders.index')){
            abort(403);
        };

        if(request()->ajax()) {
            $data = OrderTable::with(['payments', 'histories','subCategoriesTrashed','userTrashed','userTrashed.citiesTrashed'])
                ->with('orderDetails')
                ->with(['orderDetails.productService:id,commission'])
                ->orderBy('id', 'DESC')
                ->get()
                ->map(function($item ) {
                    $commissionTotal = 0;
                    $item->orderDetails->map(function ($detail) use (&$commissionTotal) {
                        $commissionTotal += $detail->quantity * $detail->productService->commission;
                    });
                    $item->commission = $commissionTotal;
                    return  $item;
                });

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
                })->addColumn('orderStatus',function ($row){
                    if($row->status_id==1){
                        return 'انتظار قبول المندوب';
                    }elseif ($row->status_id==2){
                        return 'المندوب فى الطريق للعميل';
                    }elseif ($row->status_id==3){
                        return 'المندوب فى الطريق للمغسله';
                    }elseif ($row->status_id==4){
                        return 'فى المغسله';
                    }elseif ($row->status_id==5){
                        return 'الأنتهاء من الغسيل';
                    }elseif ($row->status_id==6){
                        return 'انتظار موافقه المندوب';
                    }elseif ($row->status_id==7){
                        return 'فى الطريق للعميل';
                    }elseif ($row->status_id==8){
                        return 'الطلب منتهى';
                    }elseif ($row->status_id==10){
                        return 'الطلب ملغى';
                    }
                    return '';
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
                ->rawColumns(['action','user_id','category','user','deliveryType','orderType','orderStatus','laundryProfit','appProfit','delivery','commission','finished','city','createdAt'])
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
        $orderDetails=orderDetails::with(['productTrashed','productService'])->where('order_table_id',$id)->get();
        $totalCommission = OrderDetails::where('order_table_id', $id)
            ->with(['productService:id,commission'])
            ->get();
        return  view('dashboard.Orders.view',compact(['order','orderDetails']));//,'commissionTotal'
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
            $data = OrderTable::where("status_id",self::WaitingForDelivery)->orderBy('id', 'DESC')->get();
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
                    $current = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::WaitingForDelivery)->first();
                    $next = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::AcceptedByDelivery)->first();
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
            $data = OrderTable::where("status_id",self::AcceptedByDelivery)->with('delegateTrashed.appUserTrashed')->orderBy('id', 'DESC')->get();
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
                    $current = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::AcceptedByDelivery)->first();
                    $next = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::WayToLaundry)->first();
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
            $data = OrderTable::where("status_id",self::WayToLaundry)->orderBy('id', 'DESC')->get();
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
                    $current = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::WayToLaundry)->first();
                    $next = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::DeliveredToLaundry)->first();
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
            $data = OrderTable::with(['histories','delegateTrashed.appUserTrashed'])->where("status_id",self::DeliveredToLaundry)->orderBy('id', 'DESC')->get();
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
                    $current = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::DeliveredToLaundry)->first();
                    $next = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::ClothesReadyForDelivery)->first();
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
                ->where("status_id",self::ClothesReadyForDelivery)
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
                    $current = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::ClothesReadyForDelivery)->first();
                    $next = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::AcceptedByDeliveryToYou)->first();
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
            $data = OrderTable::where("status_id",self::WaitingForDeliveryToReceiveOrder)->orderBy('id', 'DESC')->get();
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
                    $current = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::WaitingForDeliveryToReceiveOrder)->first();
                    $next = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::AcceptedByDeliveryToYou)->first();
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
            $data = OrderTable::where("status_id",self::AcceptedByDeliveryToYou)->with('delegateTrashed.appUserTrashed')->orderBy('id', 'DESC')->get();
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
                    $current = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::AcceptedByDeliveryToYou)->first();
                    $next = $row->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::Completed)->first();
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
            $data = OrderTable::where("status_id",self::Completed)->with('delegateTrashed.appUserTrashed')->orderBy('id', 'DESC')->get();
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
            $data = OrderTable::where("status_id",self::Cancel)->with('delegateTrashed.appUserTrashed')->orderBy('id', 'DESC')->get();
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
        $orderCount= DeliveryHistory::where('user_id',$delivery_id)->get();
        if(request()->ajax()) {
            $delegate=Delegate::withTrashed()->find($id);
            $delivery_id=$delegate->app_user_id;
            $data=OrderTable::where('delivery_id',$delegate->app_user_id)->orderBy('id', 'DESC')->get();
            return   Datatables::of($data)
                ->addColumn('subCategory', function ($row) {
                    return $row->subCategoriesTrashed->name_ar ;
                })->addColumn('status', function ($row) {
                    if($row->status_id==4){
                        return 'تم التسليم للمغسله';
                    }elseif ($row->status_id==8){
                        return 'تم التسليم للعميل';
                    }
                })->addColumn('createdAt', function ($row) {
                    return $row->created_at ? $row->created_at->format('d-m-Y'):'';
                })->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                                      <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="'.Route('Order.show',$row->id).'">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>

                                </div>
                            </div>';
                })
                ->rawColumns(['subCategory','status','createdAt','action'])
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
dd( OrderTable::find($request->id)->get());
        return redirect()->back();

    }

}
