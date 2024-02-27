<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\carpetLaundry;
use App\Models\carService;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class carServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        if(request()->ajax()) {
            $data=carService::where('subCategory_id',$id)->orderBy('id','desc')->get();

            return   Datatables::of($data)
                ->addColumn('action', function ($row) {
                    return '
                              <div class="dropdown">
                               <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">

                                    <a class="dropdown-item" href="' . Route('carServices.index', $row->id) . '">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>الخدمات</span>
                                    </a>
                                     <a class="dropdown-item" href="' . Route('carLaundries.edit', $row->id) . '">
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
        return view('dashboard.carServices.index',compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $carLaundry=subCategory::find($id);
        return view('dashboard.carServices.create',compact('carLaundry'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
//        $request->validate([
//            'subCategory_id'=>'integer',
//            'category_en'=>'required',
//            'category_ar'=>'required',
//            'desc_ar'=>'required',
//            'desc_en'=>'required',
//            'price'=>'required',
//        ],[
//            'required'=>'اجبارى',
//        ]);

        $data = $request->all();
        $data['image'] = uploadFile($request->file('image'),'laundryServices');

        carService::create($data);


        return  redirect()->route('carServices.index',$request->subCategory_id)->with('success', 'تمت الاضافه');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
