<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\OrderDetails;
use App\Models\OrderTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

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

        if (request()->ajax()) {
            $data = OrderTable::orders($id)->with('userTrashed')->orderBy('id', 'DESC')->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return $row->userTrashed->name;
            })->addColumn('date', function ($row) {
                    return $row->created_at->format('d-m-Y');
            })->addColumn('orderType', function ($row) {
                    return $row->urgent=='0'? '<button type="button"  class="btn btn-outline-success" disabled>' . trans('lang.normal') . '</button>' : '<button  class="btn btn-outline-danger" disabled>' . trans('lang.urgent') . '</button>' ;
            })->addColumn('status', function ($row) {
                if($row->status_id==3){
                    return  ''.trans('lang.wayToLaundry').'';
                } elseif ($row->status_id==5){
                    return  ''.trans('lang.completedOrder').'';
                }elseif ($row->status_id==8){
                    return ''.trans('lang.finishedOrder').'';
                }elseif ($row->status_id==10){
                    return ''.trans('lang.cancelledOrder').'';
                }
                    return $row->status;
            })->addColumn('action', function ($row) {
                    return '<a href="' . Route('Customer.Orders.orderDetails', $row->id) . '" class="edit btn btn-success btn-sm">' . trans('lang.details') . '</a>';
           })->rawColumns(['user','date','status','orderType','action'])
                ->make(true);
        }
        return  view('customers.backEnd.orders.index', compact('id'));
    }

    public function incomingOrder($id)
    {
        if (request()->ajax()) {
            $data = OrderTable::orders($id)->where('status_id', self::WayToLaundry)->orderBy('id', 'DESC')->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return $row->userTrashed->name;
                })->addColumn('date', function ($row) {
                    return $row->updated_at->format('d-m-Y');;
                })->addColumn('orderType', function ($row) {
                    return $row->urgent=='0'? '<button type="button"  class="btn btn-outline-success" disabled>'.trans('lang.normal').'</button>' : '<button  class="btn btn-outline-danger" disabled>' . trans('lang.urgent') . '</button>' ;
                })->addColumn('status', function ($row) {
                    if($row->status_id==3){
                        return  ''.trans('lang.wayToLaundry').'';
                    } elseif ($row->status_id==5){
                        return  ''.trans('lang.completedOrder').'';
                    }elseif ($row->status_id==8){
                        return ''.trans('lang.finishedOrder').'';
                    }elseif ($row->status_id==10){
                        return ''.trans('lang.cancelledOrder').'';
                    }
                    return $row->status;
                })->addColumn('details', function ($row) {
                    return '<a href="' . Route('Customer.Orders.orderDetails', $row->id) . '" class="edit btn btn-success btn-sm">' . trans('lang.details') . '</a>';
                })
                ->rawColumns(['user', 'date','orderType','details'])
                ->make(true);
        }
        return  view('customers.backEnd.orders.incoming', compact('id'));
    }

    public function inProgress($id)
    {

        if (request()->ajax()) {
            $data = OrderTable::orders($id)->where('status_id', self::DeliveredToLaundry)->orderBy('id', 'DESC')->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return $row->userTrashed->name;
                })->addColumn('date', function ($row) {
                    return $row->created_at->format('d-m-Y');;
                })->addColumn('orderType', function ($row) {
                    return $row->urgent=='0'? '<button type="button"  class="btn btn-outline-success" disabled>' . trans('lang.normal') . '</button>' : '<button  class="btn btn-outline-danger" disabled>' . trans('lang.urgent') . '</button>' ;

                })->addColumn('finished', function ($row) {
                    return '<a href="' . Route('Customer.Orders.completed', $row->id) . '" class="edit btn btn-primary btn-sm">' . trans('lang.finish') . '</a>';
                })->addColumn('details', function ($row) {
                    return '<a href="' . Route('Customer.Orders.orderDetails', $row->id) . '" class="edit btn btn-success btn-sm">' . trans('lang.details') . '</a>';
                })
                ->rawColumns(['user','date','finished','orderType', 'details'])
                ->make(true);
        }

        return view('customers.backEnd.orders.inProgress', compact('id'));
    }

    public function completed($id)
    {
        $order = OrderTable::with('userTrashed')->where('id', $id)->first();
        $order->update([
            $order['status_id'] = self::ClothesReadyForDelivery,
            $order['status'] = 'تم الأنتهاء من الغسيل'
        ]);
        $order->save();
        //$app_user_id = auth()->user()->id;
        NotificationController::sendNotification(
            'ملابسك جاهزه للاستلام , نرجو اختيار طريقه الاستلام',
            'طلب رقم #' . $order->id,
            $order->userTrashed,
            $order->id
        );

        return redirect()->back();
    }
    public function canceledOrder($id)
    {
        if (request()->ajax()) {
            $data = OrderTable::orders($id)->where('status_id', self::Cancel)->orderBy('id', 'DESC')->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return $row->userTrashed->name;
                })->addColumn('date', function ($row) {
                        return $row->updated_at->format('d-m-Y');;
                    })->addColumn('details', function ($row) {
                    return '<a href="' . Route('Customer.Orders.orderDetails', $row->id) . '" class="edit btn btn-success btn-sm">' . trans('lang.details') . '</a>';
                })
                ->rawColumns(['user', 'date','details'])
                ->make(true);
        }
        return  view('customers.backEnd.orders.canceled', compact('id'));
    }
    public function finishedOrder($id)
    {

        if (request()->ajax()) {
            $data = OrderTable::orders($id)->where('status_id', self::Completed)->orderBy('id', 'DESC')->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return $row->userTrashed->name;
                })->addColumn('date', function ($row) {
                    return $row->updated_at->format('d-m-Y');;
                })->addColumn('orderType', function ($row) {
                    return $row->urgent=='0'? '<button type="button"  class="btn btn-outline-success" disabled>' . trans('lang.normal') . '</button>' : '<button  class="btn btn-outline-danger" disabled>' . trans('lang.urgent') . '</button>' ;

                })->addColumn('details', function ($row) {
                    return '<a href="' . Route('Customer.Orders.orderDetails', $row->id) . '" class="edit btn btn-success btn-sm">' . trans('lang.details') . '</a>';
                })
                ->rawColumns(['user','date' ,'orderType','details'])
                ->make(true);
        }
        return  view('customers.backEnd.orders.finished', compact('id'));
    }

    public function orderDetails($id)
    {
        $order = OrderTable::with(['subCategoriesTrashed', 'userTrashed', 'userTrashed.citiesTrashed', 'delegateTrashed.appUserTrashed'])->where('id', $id)->first();
        $orderDetails = orderDetails::with(['productTrashed', 'productService'])->where('order_table_id', $id)->get();
        return  view('customers.backEnd.orders.orderDetails', compact(['order', 'orderDetails']));
    }
}
