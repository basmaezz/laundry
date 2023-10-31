<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\carpetCategory;
use App\Models\carpetLaundry;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class carpetCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        if(request()->ajax()) {
            $data = carpetCategory::where('carpet_laundry_id',$id)->get();
            return   Datatables::of($data)
                ->addColumn('action', function ($row) {
                    return '
                              <div class="dropdown">
                               <button type="button" class="edit btn btn-info" data-toggle="dropdown">
                                    المزيد
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . Route('carpetCategories.edit', $row->id) . '">
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
        return view('dashboard.carpetCategories.index',compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $carpetLaundry=carpetLaundry::find($id);
         return view('dashboard.carpetCategories.create',compact('carpetLaundry'));
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
            'carpet_laundry_id'=>'integer',
            'category_en'=>'required',
            'category_ar'=>'required',
            'desc_ar'=>'required',
            'desc_en'=>'required',
            'price'=>'required',
        ],[
            'required'=>'اجبارى',
        ]);

        carpetCategory::create($request->all());
        return  redirect()->route('carpetCategories.index',$request->carpet_laundry_id)->with('success', 'تمت الاضافه');
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
        $carpetCategory=carpetCategory::with('carpetLaundry')->find($id);

        return view('dashboard.carpetCategories.edit',compact('carpetCategory'));

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
            'carpet_laundry_id'=>'integer',
            'category_en'=>'required',
            'category_ar'=>'required',
            'desc_ar'=>'required',
            'desc_en'=>'required',
            'price'=>'required',
        ],[
            'required'=>'اجبارى',
        ]);
        carpetCategory::where('id',$id)->update($request->except(['_token']));
        return  redirect()->route('carpetCategories.index',$id)->with('success', 'تم التعديل');
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
            carpetCategory::where('id', $request->id)->delete();
        }
        return  redirect()->back()->with('error', 'تم الحذف');
    }
}
