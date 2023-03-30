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
        if(isset($siteSetting)) {
            return view('dashboard.settings.index',compact('siteSetting'));
        }else{
            return view('dashboard.settings.index');
        }
    }
    public function create()
    {
        return view('dashboard.settings.create');

    }
    public function store(Request $request)
    {
        SiteSetting::create($request->all());
        return redirect()->route('settings.index')->with('message', 'تم الاضافه!');;
    }
    public function edit()
    {
        $siteSetting=SiteSetting::first();
        return view('dashboard.settings.edit',compact('siteSetting'));
    }
    public function update(Request $request)
    {
        $siteSetting=SiteSetting::where('id',$request->id)->update($request->except(['_method','_token','id']));
        return redirect()->route('settings.index')->with('message', 'تمت التعديل!');
    }
}
