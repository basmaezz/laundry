<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Bank;
use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class CarTypeController extends ApiController
{

    public function main(){
        $car_types = CarType::get();
        return  view('dashboard.car_type.index',['car_types'=>$car_types]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carTypes = CarType::all();
        $name = 'name_' . App::getLocale();
        $data = [];
        foreach ($carTypes as $carType) {
            $data [] = [
                'id'   => $carType->id,
                'name' => $carType->$name,
            ];
        }
        return apiResponse("api.success", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name_ar'  => 'required',
            'name_en'  => 'required',
        ],[
            'name_ar.required'    =>'يجب ادخال النوع ',
            'name_en.required'    =>'يجب ادخال النوع En',
        ]);

        CarType::create($request->all());
        Session::flash('success', 'تم اضافة السؤال بنجاح');
        return redirect()->back();
    }

    public function update($id,Request  $request){
        $this->validate($request, [
            'name_ar'  => 'required',
            'name_en'  => 'required',
        ],[
            'name_ar.required'    =>'يجب ادخال النوع ',
            'name_en.required'    =>'يجب ادخال النوع En',
        ]);

        CarType::where('id',$id)->update($request->except(['_method','_token','id']));
        Session::flash('success', 'تم تعديل النوع بنجاح');
        return redirect()->back();
    }

    public function destroy($id,Request $request){
        CarType::where('id',$id)->delete();
        Session::flash('success', 'تم حذف النوع بنجاح');
        return redirect()->back();
    }
}
