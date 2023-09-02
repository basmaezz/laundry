<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\OrderTable;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        return view('customers.Auth.login');
    }

    public function customerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials) && Auth::user()->subCategory_id != '')
        {
            return redirect()->route('customer.index');
        }
        return redirect()->back()->withSuccess('Login details are not valid');
    }
    public function main()
    {
        $appUsers = AppUser::count();
        $monthlyOrders=OrderTable::select('*')->where('laundry_id',Auth::user()->subCategory_id)->whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
        $monthlyProfit=OrderTable::select('*')->where('laundry_id',Auth::user()->subCategory_id)->whereMonth('created_at', \Carbon\Carbon::now()->month)->sum('sum_price');
        return view('customers.backEnd.main',compact(['monthlyOrders','monthlyProfit']));
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        return redirect("customer.login")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect()->route('customer.login');
    }


    public function destroyLaundryAdmin(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('customer.laundryLogin');
    }

    public function profile()
    {
        $laundry=Subcategory::where('id',Auth::user()->subCategory_id)->first();
        return view('customers.backEnd.profile',compact('laundry'));
    }
}
