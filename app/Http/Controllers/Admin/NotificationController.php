<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\City;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{


    public function index()
    {

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
}
