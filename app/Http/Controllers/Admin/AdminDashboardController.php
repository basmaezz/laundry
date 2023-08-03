<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\OrderTable;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data = [];

        $citiesWithOrderCount = City::select('cities.id', 'cities.name_ar', DB::raw('COUNT(order_tables.id) as orders_count'))
            ->leftJoin('app_users', 'cities.id', '=','app_users.city_id')
            ->leftJoin('order_tables', 'app_users.id', '=', 'order_tables.user_id')
            ->groupBy('cities.id')
            ->havingRaw('orders_count > 0')
            ->get() ;

        $monthlyOrder=OrderTable::select('order_tables.id',DB::raw('COUNT(id) as data '),DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
            DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupBy('order_tables.id')->groupBy('order_tables.id')->get();


        return view('dashboard', compact('citiesWithOrderCount'));
    }
}
