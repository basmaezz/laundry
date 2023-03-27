<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;


class SettingController extends Controller
{
    public function index()
    {
        $siteSetting=SiteSetting::first();
        return view('dashboard.settings.index',compact('siteSetting'));
    }
    public function create()
    {
        return view('dashboard.settings.create');

    }
    public function store(Request $request)
    {
        SiteSetting::create($request->all());
        return redirect()->route('settings.index');

    }
}
