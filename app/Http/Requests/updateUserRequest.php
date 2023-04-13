<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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
            'name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'level_id'=>'required',
            'birthdate'=>'required',
            'joinDate'=>'required',
//            'avatar'=>['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ];
    }

    public function messages()
    {
        return[
        'required' =>'هذا الحقل مطلوب',

        ];
    }
}
