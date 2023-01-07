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
            'name'=>'required ',
            'last_name'=>'required ',
            'email'=>'required',
            'password'=>'required',
            'phone'=>'required',
            'avatar'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'level_id'=>'required',
            'birthdate'=>[   'required',
                function($attribute, $value, $fail){
                    if($value >= 1990 && $value <= date('Y')){
                        $fail("The :attribute must be between 1990 to ".date('Y').".");
                    }
                }],
            'joindate'=>'required',

        ];
    }
}
