<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\carpetCategory;
use App\Models\carpetLaundry;
use App\Models\carpetLaundryTime;
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
        $carpetLaundryReceivedTimes = carpetLaundryTime::where('carpet_laundry_id',$id)->where('service_type','received')->get();
        $carpetLaundryDeliveredTimes = carpetLaundryTime::where('carpet_laundry_id',$id)->where('service_type','delivered')->get();

//        if(request()->ajax()) {
//
//            return   Datatables::of($data)
//                ->addColumn('received_at', function ($row) {
//                   return date('h:i A', strtotime($row->received_at_start)) .'<br>' .'-' . '<br>'.  date('h:i A', strtotime($row->received_to_end));
//                })->addColumn('delivered_to', function ($row) {
//                   return date('h:i A', strtotime($row->)) .'<br>' .'-' . '<br>'.  date('h:i A', strtotime($row->));
//                })->addColumn('action', function ($row) {
//                    return '
//                              <div class="dropdown">
//                               <button type="button" class="edit btn btn-info" data-toggle="dropdown">
//                                    المزيد
//                                </button>
//                                <div class="dropdown-menu">
//                                    <a class="dropdown-item" href="' . Route('carpetCategories.edit', $row->id) . '">
//                                        <i data-feather="edit-2" class="mr-50"></i>
//                                        <span>تعديل</span>
//                                    </a>
//                                    <a class="dropdown-item" id="deleteBtn" data-id="' . $row->id . '"  data-toggle="modal">
//                                        <i data-feather="trash" class="mr-50"></i>
//                                        <span>حذف</span>
//                                    </a>
//                                </div>
//                            </div>  ';
//                })
//                ->rawColumns(['received_at','delivered_to','action'])
//                ->make(true);
//        }
        return view('dashboard.carpetLaundryTimes.index',compact(['carpetLaundryReceivedTimes','carpetLaundryDeliveredTimes','id']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $carpetLaundry=carpetLaundry::find($id);
        return view('dashboard.carpetLaundryTimes.create',compact('carpetLaundry'));
    }
    public function createDeliveredTimes($id)
    {
        $carpetLaundry=carpetLaundry::find($id);
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
        return  redirect()->route('carpetLaundryTimes.index',$request->carpet_laundry_id)->with('success', 'تمت الاضافه');
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
       $carpetLaundryTime=carpetLaundryTime::with('carpetLaundry')->find($id);

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
        return  redirect()->route('carpetLaundryTimes.index',$request->carpet_laundry_id)->with('success', 'تم التعديل');
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
