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
            $data = OrderTable::orders($id)->with('userTrashed')->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return $row->userTrashed->name;
                })->addColumn('action', function ($row) {
                    return '<a href="' . Route('Customer.Orders.orderDetails', $row->id) . '" class="edit btn btn-success btn-sm">' . trans('lang.details') . '</a>';
                })
                ->rawColumns(['user', 'action'])
                ->make(true);
        }

        return  view('customers.backEnd.orders.index', compact('id'));
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

        if (request()->ajax()) {
            $data = OrderTable::orders($id)->where('status_id', self::DeliveredToLaundry)->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return $row->userTrashed->name;
                })->addColumn('inProgress', function ($row) {
                    return '<button class="edit btn btn-info btn-sm">Order In Progress</button>';
                })->addColumn('finished', function ($row) {
                    return '<a href="' . Route('Customer.Orders.completed', $row->id) . '" class="edit btn btn-success btn-sm">' . trans('lang.finish') . '</a>';
                })->addColumn('details', function ($row) {
                    return '<a href="' . Route('Customer.Orders.orderDetails', $row->id) . '" class="edit btn btn-success btn-sm">' . trans('lang.details') . '</a>';
                })
                ->rawColumns(['user', 'inProgress', 'finished', 'details'])
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
            $data = OrderTable::orders($id)->where('status_id', self::Cancel)->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return $row->userTrashed->name;
                })->addColumn('details', function ($row) {
                    return '<a href="' . Route('Customer.Orders.orderDetails', $row->id) . '" class="edit btn btn-success btn-sm">' . trans('lang.details') . '</a>';
                })
                ->rawColumns(['user', 'details'])
                ->make(true);
        }
        return  view('customers.backEnd.orders.canceled', compact('id'));
    }
    public function finishedOrder($id)
    {

        if (request()->ajax()) {
            $data = OrderTable::orders($id)->where('status_id', self::Completed)->get();

            return   Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return $row->userTrashed->name;
                })->addColumn('details', function ($row) {
                    return '<a href="' . Route('Customer.Orders.orderDetails', $row->id) . '" class="edit btn btn-success btn-sm">' . trans('lang.details') . '</a>';
                })
                ->rawColumns(['user', 'details'])
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
