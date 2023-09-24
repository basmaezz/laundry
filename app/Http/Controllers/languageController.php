<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class languageController extends Controller
{
    public function index(Request $request)
    {

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        $previousRoute = url()->previous();
        $laundry=Subcategory::where('id',Auth::user()->subCategory_id)->first();
//        if (Str::contains($previousRoute, ['customerLogin'])) {
//            return view('customers.backEnd.main');
//        } else {
//            return view('customers.backEnd.main');
//
//        }
        return redirect()->route('customer.index',['laundry'=>$laundry]);
    }
}
