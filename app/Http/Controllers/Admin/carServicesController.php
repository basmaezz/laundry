<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\carpetLaundry;
use App\Models\carService;
use App\Models\Subcategory;
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
            $data=carService::where('Subcategory_id',$id)->orderBy('id','desc')->get();

            return   Datatables::of($data)
                ->addColumn('action', function ($row) {
                    return '
                              <div class="dropdown">
                               <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">

                                     <a class="dropdown-item" href="' . Route('carServices.edit', $row->id) . '">
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
        $Subcategory=Subcategory::find($id);

        return view('dashboard.carServices.create',compact('Subcategory'));
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
            'name_ar'=>'required',
            'name_en'=>'required',
            'desc_ar'=>'required',
            'desc_en'=>'required',
            'price'=>'required',
            'image'=>'required',
        ],[
            'required'=>'اجبارى',
        ]);
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
        $carService=carService::find($id);
        return view('dashboard.carServices.edit',compact('carService'));
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
            'name_ar'=>'required',
            'name_en'=>'required',
            'desc_ar'=>'required',
            'desc_en'=>'required',
            'price'=>'required',
        ],[
            'required'=>'اجبارى',
        ]);
        if(!empty($request->file('image'))){
            $image = uploadFile($request->file('image'),'laundryServices');
            carService::where('id',$id)->update([
           'image'=>$image,
            $request->except(['_token'])]);
        }
        carService::where('id',$id)->update($request->except(['_token']));

        return redirect()->back();
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
