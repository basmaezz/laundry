<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\BirthYearRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
    public function rules(Request $request)
    {
        return [
            'name'=>['required', 'min:4','max:20'],
            'last_name'=>['required', 'min:4','max:20'],
            'email' => 'required|unique:users|required|regex:/(.+)@(.+)\.(.+)/i',
            'password'=>['required','min:6'],
            'birthdate'=> ['required','before:15 years ago'],
            'phone'=>'required|unique:users|numeric|digits:10',
            'avatar'=>['image','required','mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ];
    }

    public function messages()
    {
        return [
            'required'  =>'هذا الحقل مطلوب',
            'name'=>'برجاء ادخال اسم مناسب',
            'last_name'=>'برجاء ادخال اسم مناسب',
            'unique'=>'هذا الرقم موجود بالفعل',
            'email'=>'هذا البريد الالكترونى موجود مسبقا',
            'phone'=>'هذا الرقم غير صحيح',
            'birthdate'=>'تاريخ الميلاد غير مناسب '
        ];
    }
}
