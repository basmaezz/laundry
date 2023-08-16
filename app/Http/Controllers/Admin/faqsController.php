<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class faqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs=Faq::all();
        return  view('dashboard.faqs.index',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('dashboard.faqs.create');
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
            'question_ar'=>'required',
            'question_en'=>'required',
            'answer_ar'=>'required',
            'answer_en'=>'required',
        ],[
            'required'=>'اجبارى',
        ]);
        Faq::create($request->all());
        return  redirect()->route('faqs.index')->with('success', 'تمت الاضافه');
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
        $faq=Faq::find($id);
        return view('dashboard.faqs.edit',compact('faq'));
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
            'question_ar'=>'required',
            'question_en'=>'required',
            'answer_ar'=>'required',
            'answer_en'=>'required',
        ],[
            'required'=>'اجبارى'
        ]);
        Faq::where('id',$id)->update($request->except(['_token']));
        return  redirect()->route('faqs.index')->with('success', 'تم التعديل');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Faq::where('id', $id)->delete();
        return  redirect()->back()->with('error', 'تم الحذف');
    }
}
