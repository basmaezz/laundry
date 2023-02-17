<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index(){
        return view('customers.Auth.login');
    }

    public function customerLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) && Auth::user()->subCategory_id !='' ) {
            return view('customers.backEnd.main');
       }

        return redirect()->back()->withSuccess('Login details are not valid');
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
        return redirect("customer.login")->withSuccess('You are not allowed to access');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect()->route('customer.login');
    }

    public function main(){
        $appUsers=AppUser::count();
//        dd($appUsers);
        return view('customers.backEnd.main');
    }

}
