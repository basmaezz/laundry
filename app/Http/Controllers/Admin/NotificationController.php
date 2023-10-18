<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\City;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class NotificationController extends Controller
{


    public function index()
    {
        $data=Notifications::all()->unique('title_ar')->whereIn('type',['customer','delivery'])->toArray();
        if(request()->ajax()) {
            $data=Notifications::all()->unique('title_ar')->whereIn('type',['customer','delivery'])->toArray();

            return   Datatables::of($data)

              ->addColumn('action', function ($row) {
                    return ' <div class="dropdown" style="margin-right: -58px;">
                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu" style="margin-right: -58px;">
                                    <a class="dropdown-item" href="' . Route('notification.viewCustomerNotification', $row['id']) . '">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>التفاصيل</span>
                                    </a>

                                </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.notifications.index');
    }
    public function create()
    {
        return view('dashboard.notifications.create');
    }
    public function store(Request $request)
    {
        $delegates = AppUser::where([
            'user_type' => 'delivery',
        ])->get();

        foreach ($delegates as $user) {
            Notifications::create([
                'title_ar'=>$request->title_ar,
                'content_ar'=>$request->content_ar,
                'app_user_id'=>$user->id,
                'type'=>$user->user_type
            ]);

            \App\Http\Controllers\API\NotificationController::sendNotification(
                $request->title_ar,
                $request->content_ar,
                $user,
            );
        }

        return redirect()->back();

    }
    public function customerNotification()
    {
        $cities=City::all();
        $customers=AppUser::where('user_type',"customer")->get();
        return view('dashboard.notifications.customerNotification',compact('cities','customers'));
    }

    public function storeCustomerNotification(Request $request)
    {

        $result=[];
        switch ($request->selectCategory){
            case('all');
                $customers = AppUser::where('user_type', 'customer')->get();

                foreach ($customers as $customer){
                    Notifications::create([
                        'title_ar'=>$request->title_ar,
                        'content_ar'=>$request->content_ar,
                        'app_user_id'=>$customer->id,
                        'type'=>$customer->user_type
                    ]);
                    \App\Http\Controllers\API\NotificationController::sendNotification(
                        $request->title_ar,
                        $request->content_ar,
                        $customer,
                    );
                }
            break;
            case('customers');
                if($request->gender!='all'){
                    foreach($request->cities as $city){
                        $customers = AppUser::where('user_type', 'customer')->where('city_id',$city)->where('gender',$request->gender)->get();
                        array_push($result, $customers);
                    }
                }else{
                    foreach($request->cities as $city){
                        $customers = AppUser::where('user_type', 'customer')->where('city_id',$city)->get();
                        array_push($result, $customers);
                    }
                }


                foreach ($result as $customers) {
                    foreach ($customers as $customer){
                        Notifications::create([
                            'title_ar'=>$request->title_ar,
                            'content_ar'=>$request->content_ar,
                            'app_user_id'=>$customer->id,
                            'type'=>$customer->user_type
                        ]);
                        \App\Http\Controllers\API\NotificationController::sendNotification(
                            $request->title_ar,
                            $request->content_ar,
                            $customer,
                        );
                    }
                }
            break;
            case('customer');
                $customer = AppUser::where('id',$request->app_user_id)->first();
                Notifications::create([
                    'title_ar'=>$request->title_ar,
                    'content_ar'=>$request->content_ar,
                    'app_user_id'=>$customer->id,
                    'type'=>$customer->user_type
                ]);
                \App\Http\Controllers\API\NotificationController::sendNotification(
                    $request->title_ar,
                    $request->content_ar,
                    $customer,
                );
            break;
        }




        return redirect()->route('notification.index');

    }
    public function viewCustomerNotification($id)
    {
      $notification=Notifications::find($id);
      $count=Notifications::select('*')->where('title_ar',$notification->title_ar)->whereIn('type',['customer','delivery'])->count();
        return view('dashboard.notifications.viewCustomerNotification',compact('notification', 'count'));

    }
    public function sendNotification(Request $request)
    {
        $appUsers=AppUser::where([
            'city_id'=>$request->city_id,
            'gender'=>$request->gender
        ])->get();

        foreach ($appUsers as $user) {
            \App\Http\Controllers\API\NotificationController::sendNotification(
                $request->title,
                $request->body,
                $user,
            );
        }
        return redirect()->back();
    }
    public function resendNotification($id)
    {

    }
}
