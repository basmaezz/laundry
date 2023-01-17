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
            'name'=>['required', 'unique:users', 'max:255'],
            'last_name'=>['required', 'unique:users', 'max:255'],
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            'birthdate'=> ['required'],
//            'birthdate'=> ['required', 'before:15 years ago'],
            'phone'=>'required',
////            'avatar'=>'required',
            'level_id'=>'required',
            'joinDate'=>'required',

        ];
    }

    public function messages()
    {
        return [
          'required'  =>'هذا الحقل مطلوب',
            'email'=>'هذا البريد الالكترونى موجود مسبقا',
            'phone'=>'هذا الرقم غير صحيح'
        ];
    }
}
