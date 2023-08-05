<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        if(!Gate::allows('cities.index')){
//            abort(403);
//        };

        if(request()->ajax()) {
            $data = City::get();
            return   Datatables::of($data)
               ->addColumn('action', function ($row) {
                    return '<a href="' . Route('city.edit', $row->id) . '"  class="edit btn btn-primary btn-sm" style="width: 18px;height: 20px;" ><i class="fa fa-edit"></i></a>
             <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal"style="width: 18px;height: 20px;" ><i class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.cities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
             return view('dashboard.cities.create');
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
        ],[
            'required'=>'اجبارى',
        ]);
        City::create($request->all());
        return  redirect()->route('cities.index')->with('success', 'تمت الاضافه');
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
            $city=City::find($id);
        return view('dashboard.cities.edit',compact('city'));
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
        ],[
            'required'=>'اجبارى'
        ]);
        City::where('id',$id)->update($request->except(['_token']));
        return  redirect()->route('cities.index')->with('success', 'تم التعديل');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if (is_numeric($request->id)) {
            City::where('id', $request->id)->delete();
        }
        return  redirect()->back()->with('error', 'تم الحذف');
    }
}
