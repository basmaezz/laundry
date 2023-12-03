<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\carpetCategory;
use App\Models\carpetLaundry;
use App\Models\carpetLaundryTime;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class carpetLaundryTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $carpetLaundryReceivedTimes = carpetLaundryTime::where('subCategory_id',$id)->where('service_type','received')->get();
        $carpetLaundryDeliveredTimes = carpetLaundryTime::where('subCategory_id',$id)->where('service_type','delivered')->get();
        return view('dashboard.carpetLaundryTimes.index',compact(['carpetLaundryReceivedTimes','carpetLaundryDeliveredTimes','id']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $carpetLaundry=Subcategory::find($id);
        return view('dashboard.carpetLaundryTimes.create',compact('carpetLaundry'));
    }
    public function createDeliveredTimes($id)
    {
        $carpetLaundry=Subcategory::find($id);
        return view('dashboard.carpetLaundryTimes.createDeliveredTimes',compact('carpetLaundry'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                 'start_from'=>'date_format:H:i',
                 'end_to'=>'date_format:H:i',
                  'service_type'=>'required',
        ],[
            'required'=>'اجبارى',
        ]);

        carpetLaundryTime::create($request->all());
        return  redirect()->route('carpetLaundryTimes.index',$request->subCategory_id)->with('success', 'تمت الاضافه');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $carpetLaundryTime=carpetLaundryTime::with('subCategory')->find($id);
        return view('dashboard.carpetLaundryTimes.edit',compact('carpetLaundryTime'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        carpetLaundryTime::where('id',$id)->update($request->except(['_token']));
        return  redirect()->route('carpetLaundryTimes.index',$request->subCategory_id)->with('success', 'تم التعديل');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (is_numeric($id)) {
            carpetLaundryTime::where('id', $id)->delete();
        }
        return  redirect()->back()->with('error', 'تم الحذف');
    }
}
