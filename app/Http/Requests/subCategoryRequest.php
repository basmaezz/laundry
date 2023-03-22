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
            'category_id'=>'integer',
            'name_ar' =>'required|unique:subcategories',
            'name_en' =>'required|unique:subcategories',
            'city_id' =>'required',
            'location'=>'required',
//            'lat' =>'required',
//            'lng' =>'required',
            'address'=>'required',
            'price' =>'required',
            'around_clock' =>'required',
            'clock_at' =>'string',
            'clock_end' =>'string',
        'approximate_duration'=>'required',
            'status'=>'1',
            'rate'=>'5',
            'image' => 'image|mimes:jpg,png,jpeg',

        ];
    }

    public function messages(){
        return[
            'unique'=>'هذا الاسم موجود بالفعل ',
            'required' =>'هذا الحقل مطلوب '
        ];
    }
}
