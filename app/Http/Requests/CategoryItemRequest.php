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
                'required', 'string', 'min:5','max:20',
                function ($attribute, $value, $fail) use ($request) {
                    $name_exists = categoryItem::where('category_type', $value)->where('subcategory_id', request()->input('subcategory_id'))->count() > 0;
                    if ($name_exists)  {
                        $fail($request->category_type.' هذا الاسم موجود بالفعل.');
                    }
                }
            ],
        ];
    }

    public function  messages()
    {
        return[
        'required'=>'هذا الحقل مطلوب',
        ];
    }


}
