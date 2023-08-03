<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class languageController extends Controller
{
    public function index(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        $previousRoute=url()->previous();
        if (Str::contains($previousRoute, ['customerLogin'])) {
            return view('customers.backEnd.main');
        }else{
            return redirect()->back();
        }
//        return view('customers.backEnd.main');
    }
}
