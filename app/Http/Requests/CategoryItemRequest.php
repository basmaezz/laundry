<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\CategoryItem;


class CategoryItemRequest extends FormRequest
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
            'subcategory_id' => ['required', 'integer', 'min:1'],
            'category_type' => [
                'required','string',
//                function ($attribute, $value, $fail) use ($request) {
//                    $name_exists = categoryItem::where('category_type', $value)->where('subcategory_id', request()->input('subcategory_id'))->count() > 0;
//                    if ($name_exists)  {
//                        $fail($request->category_type.' هذا الاسم موجود بالفعل.');
//                    }
//                }
            ],
            'category_type_en'=>'string',
            'category_type_franco'=>'string',
        ];
    }

    public function  messages()
    {
        return[
            'string'=>'هذا الحقل يقبل حروف فقط',
            'regex'=>'هذا الحقل يقبل حروف فقط',
        'required'=>'هذا الحقل مطلوب',
        ];
    }


}
