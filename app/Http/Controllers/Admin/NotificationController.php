<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\City;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function create()
    {

        $cities=City::all();
        return view('dashboard.notifications.create',compact('cities'));
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
