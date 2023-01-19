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
//            'name'=>['required', 'unique:users', 'max:255'],
            'name'=>array('required','regex:/(^([a-zA-Z]+)(\d+)?$)/u'),
//            'last_name'=>['required','unique:users', 'max:255'],
            'last_name'=>array('required','regex:/(^([a-zA-Z]+)(\d+)?$)/u'),
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            'birthdate'=> ['required','before:15 years ago'],
            'phone'=>'required|numeric|digits:10',
        ];
        if ($this->getMethod() == 'POST') {
            $rules += [
                'avatar'=>'required',
                'level_id'=>'required',
                'joinDate'=>'required',
                ];
        }
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
