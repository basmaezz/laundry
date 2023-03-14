<?php

namespace App\Http\Requests;

use App\Rules\BirthYearRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>array('required','unique:users','regex:/(^([a-zA-Z]+)(\d+)?$)/u'),
            'last_name'=>array('required','unique:users','regex:/(^([a-zA-Z]+)(\d+)?$)/u'),
            'email' => 'unique:users,email',
            'password'=>'required',
//            'email'=>'required|email|unique:users,email',
//            'password'=>'required',
//            'birthdate'=> ['required','before:15 years ago'],
            'birthdate'=> 'required',
            'phone'=>'required|numeric|digits:10',
            'avatar'=>['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ];

    }

    public function messages()
    {
        return [
            'required'  =>'هذا الحقل مطلوب',
            'name'=>'برجاء ادخال اسم مناسب',
            'last_name'=>'برجاء ادخال اسم مناسب',
            'unique'=>'هذا الأسم موجود مسبقا',
            'email'=>'هذا البريد الالكترونى موجود مسبقا',
            'phone'=>'هذا الرقم غير صحيح',
            'birthdate'=>'تاريخ الميلاد غير مناسب '
        ];
    }
}
