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
        if(request()->ajax()) {
            $data=Notifications::all()->unique('title_ar')->whereIn('type',['customer','delivery'])->toArray();
            return   Datatables::of($data)
              ->addColumn('action', function ($row) {
                    return '<a href="' . Route('laundries.view', $row['id']) . '"  class="edit btn btn-info btn-sm" style="max-height: 20px !important; max-width: 70px !important;" >اعاده ارسال</a>';
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
        return view('dashboard.notifications.customerNotification',compact('cities'));
    }

    public function storeCustomerNotification(Request $request)
    {
        $customers = AppUser::where([
            'user_type' => 'customer',
            'city_id'=>$request->city_id,
            'gender'=>$request->gender
        ])->get();

        foreach ($customers as $user) {
            Notifications::create([
                'title_ar'=>$request->title_ar,
                'content_ar'=>$request->content_ar,
                'app_user_id'=>$user->id,
                'type'=>$user->user_type
            ]);
        }
        foreach ($customers as $user) {
            \App\Http\Controllers\API\NotificationController::sendNotification(
                $request->title_ar,
                $request->content_ar,
                $user,
            );
        }
        return redirect()->back();

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
