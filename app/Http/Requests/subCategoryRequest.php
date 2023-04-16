<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class subCategoryRequest extends FormRequest
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
            'category_id' => 'integer',
            'name_ar' => 'required',
            'name_en' => 'required',
            'city_id' => 'required',
            'location' => 'required', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',
            'lat' => 'required',
            'lng' => 'required',
            'address' => 'required',
            'price' => 'required',
            'range' => 'required',
            'name' => 'required',
            'last_name' => 'required',
            'email' => '|unique:users|required|regex:/(.+)@(.+)\.(.+)/i',
            'password' => ['required', 'min:6'],
            'phone' => 'required|unique:users',

        ];
    }

    public function messages(){
        return[
            'unique'=>'هذا الاسم موجود بالفعل ',
            'location.format'=>'الرابط غير صحيح ',
            'required' =>'هذا الحقل مطلوب ',
            'phone.required'=>'رقم الجوال موجود مسبقا'
        ];
    }
}
