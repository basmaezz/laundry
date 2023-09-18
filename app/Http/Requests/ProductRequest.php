<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_item_id'=>'required',
            'subcategory_id' =>'required',
//            'name_ar'=>['required', 'string','max:20',
//                function ($attribute, $value, $fail) use ($request) {
//                   $name_exists = Product::where('name_ar', $value)->where('category_item_id', request()->input('category_item_id'))->count() > 0;
//                    if ($name_exists)  {
//                        $fail($request->name_ar.' هذا الاسم موجود بالفعل.');
//                    }
//                }],
//            'name_en'=>['required', 'string','max:20',
//                function ($attribute, $value, $fail) use ($request) {
//                   $name_exists = Product::where('name_en', $value)->where('category_item_id', request()->input('category_item_id'))->count() > 0;
//                    if ($name_exists)  {
//                        $fail($request->name_en.' هذا الاسم موجود بالفعل.');
//                    }
//                }],
            'name_ar'=>'required',
            'name_en'=>'required',
            'desc_ar'=>'required',
            'desc_en'=>'required',
            'subProductImage'=>'required'
        ];
    }
    public function  messages()
    {
        return[
            'required'=>'هذا الحقل مطلوب',
        ];
    }
}
