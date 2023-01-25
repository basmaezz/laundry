<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class BankController extends ApiController
{

    public function main(){
        $banks = Bank::get();
        return  view('dashboard.bank.index',['banks'=>$banks]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();
        $name = 'name_' . App::getLocale();
        $data = [];
        foreach ($banks as $bank) {
            $data [] = [
                'id'   => $bank->id,
                'name' => $bank->$name,
            ];
        }
        return apiResponse("api.success", $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_ar'  => 'required',
            'name_en'  => 'required',
        ],[
            'name_ar.required'    =>'يجب ادخال اسم البنك',
            'name_en.required'    =>'يجب ادخال إسم البنك En',
        ]);

        Bank::create($request->all());
        Session::flash('success', 'تم اضافة السؤال بنجاح');
        return redirect()->back();
    }

    public function update($id,Request $request)
    {
        $this->validate($request, [
            'name_ar'  => 'required',
            'name_en'  => 'required',
        ],[
            'name_ar.required'    =>'يجب ادخال اسم البنك',
            'name_en.required'    =>'يجب ادخال إسم البنك En',
        ]);
        Bank::where('id',$id)->update($request->except(['_method','_token','id']));
        Session::flash('success', 'تم تعديل النوع بنجاح');
        return redirect()->back();
    }

    public function destroy($id,Request $request)
    {
        Bank::where('id',$id)->delete();
        Session::flash('success', 'تم حذف النوع بنجاح');
        return redirect()->back();
    }
}
