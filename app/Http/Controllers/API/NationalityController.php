<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class NationalityController extends ApiController
{
    public function index(){
        $nationalities = Nationality::all();
        $name = 'name_' . App::getLocale();
        $data = [];
        foreach ($nationalities as $nationality) {
            $data [] = [
                'id'   => $nationality->id,
                'name' => $nationality->$name,
            ];
        }
        return apiResponse("api.success", $data);
    }
    public function store(Request $request){
        $this->validate($request, [
            'name_ar'  => 'required_without_all:name_en',
            'name_en'  => 'required_without_all:name_ar',
        ],[
            'name_ar.required'    =>'يجب ادخال الجنسيه ',
            'name_en.required'    =>'يجب ادخال الجنسيه En',
        ]);

        Nationality::create($request->all());
        Session::flash('success', 'تم اضافة الجنسيه بنجاح');
        return redirect()->back();

    }
}
