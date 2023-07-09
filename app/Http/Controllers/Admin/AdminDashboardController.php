<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data = [];

        $citiesWithOrderCount = City::select('cities.*', DB::raw('COUNT(orders.id) as orders_count'))
            ->leftJoin('users', 'cities.id', '=','users.city_id')
            ->leftJoin('orders', 'users.id', '=', 'orders.user_id')
            ->groupBy('cities.id')
            ->get()
        ;

        $cities = City::select('name_ar', 'id')->get();

        return [
            'citiesWithOrderCount' => $citiesWithOrderCount,
//            'cities' => $cities,
        ];

        //return view('dashboard');
    }
}
