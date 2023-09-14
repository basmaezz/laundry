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

    public function create()
    {
        $cities=City::all();
        return view('dashboard.notifications.create',compact('cities'));
    }
    public function index()
    {

    }

    public function store(Request $request)
    {
        $delegates = AppUser::where([
            'user_type' => 'delivery',
        ])->get();

        foreach ($delegates as $user) {
            Notifications::create([
                'title_ar'=>$request->title_ar,
                'title_en'=>$request->title_en,
                'content_ar'=>$request->content_ar,
                'content_en'=>$request->content_en,
                'app_user_id'=>$user->id,
                'type'=>$user->user_type
            ]);

            \App\Http\Controllers\API\NotificationController::sendNotification(
                $request->title_en,
                $request->content_en,
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
