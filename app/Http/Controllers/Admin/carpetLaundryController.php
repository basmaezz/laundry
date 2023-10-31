<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\carpetLaundry;
use App\Models\CarType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class carpetLaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->ajax()) {
            $data = carpetLaundry::get();
            return   Datatables::of($data)
                ->addColumn('action', function ($row) {
                    return '
                              <div class="dropdown">
                               <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . Route('carpetLaundryTimes.index', $row->id) . '">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>الفترات</span>
                                    </a>
                                      <a class="dropdown-item" href="' . Route('carpetCategories.index', $row->id) . '">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>المنتجات</span>
                                    </a>
                                    <a class="dropdown-item" href="' . Route('carpetLaundries.edit', $row->id) . '">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>تعديل</span>
                                    </a>
                                    <a class="dropdown-item" id="deleteBtn" data-id="' . $row->id . '"  data-toggle="modal">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>حذف</span>
                                    </a>
                                </div>
                            </div>  ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.carpetLaundries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.carpetLaundries.create');
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
            'area_name'=>'required',
            'approximate_duration'=>'required',
            'lat'=>'required',
            'lng'=>'required',
            'range'=>'required',
        ],[
            'required'=>'اجبارى',
        ]);
        carpetLaundry::create($request->all());
        return  redirect()->route('carpetLaundries.index')->with('success', 'تمت الاضافه');
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
        $carpetLaundry=carpetLaundry::find($id);
        return view('dashboard.carpetLaundries.edit',compact('carpetLaundry'));
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
        $request->validate([
            'area_name'=>'required',
            'approximate_duration'=>'required',
            'lat'=>'required',
            'lng'=>'required',
            'range'=>'required',
        ],[
            'required'=>'اجبارى',
        ]);
        carpetLaundry::where('id',$id)->update($request->except(['_token']));
        return  redirect()->route('carpetLaundries.index')->with('success', 'تم التعديل');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (is_numeric($request->id)) {
            carpetLaundry::where('id', $request->id)->delete();
        }
        return  redirect()->back()->with('error', 'تم الحذف');
    }
}
