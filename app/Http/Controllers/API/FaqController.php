<?php

namespace App\Http\Controllers\API;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    public function getFaqs(){
        $faqs = Faq::query()->limit(50)->get();
        return apiResponse('api.success', ['data' => $faqs]);
    }

    public function index(){
        $faqs = Faq::get();
        return  view('dashboard.faq.index',['faqs'=>$faqs]);
    }

    public function store(Request $request){
        //dd($request->all());
        $this->validate($request, [
            'question_ar'  => 'required',
            'question_en'  => 'required',
            'answer_ar'    => 'required',
            'answer_en'    => 'required',
        ],[
            'question_ar.required'    =>'يجب ادخال السؤال ',
            'question_en.required'    =>'يجب ادخال السؤال En',
            'answer_ar.required' =>'يجب إدخال الإجابة',
            'answer_en.required' =>'يجب إدخال الإجابة En',
        ]);
        Faq::create($request->all());
        Session::flash('success', 'تم اضافة السؤال بنجاح');
        return redirect()->back();
    }

    public function update($id,Request  $request){
        $this->validate($request, [
            'question_ar'  => 'required',
            'question_en'  => 'required',
            'answer_ar'    => 'required',
            'answer_en'    => 'required',
        ],[
            'question_ar.required'    =>'يجب ادخال السؤال ',
            'question_en.required'    =>'يجب ادخال السؤال En',
            'answer_ar.required' =>'يجب إدخال الإجابة',
            'answer_en.required' =>'يجب إدخال الإجابة En',
        ]);
        Faq::where('id',$id)->update($request->except(['_method','_token','id']));
        Session::flash('success', 'تم تعديل السؤال بنجاح');
        return redirect()->back();
    }

    public function destroy($id,Request $request){
        Faq::where('id',$id)->delete();
        Session::flash('success', 'تم حذف السؤال بنجاح');
        return redirect()->back();
    }
}
