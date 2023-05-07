<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function create()
    {
        $cities=City::all();
        return view('dashboard.notifications.create',compact('cities'));
    }

    public function store(Request $request)
    {



    }
}
