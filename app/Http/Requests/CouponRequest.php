<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
        $rules = [
            'code_name' => 'required',
            'discount_value' => 'required|numeric',
            'date_from' => 'required',
            'date_to' => 'required',
            'status' => 'required',
        ];

        //        if ($this->getMethod() == 'POST') {
        //            $rules += ['code_name'=>'required|unique:coupon_shop_carts',];
        //        }elseif ($this->getMethod() == 'PATCH'){
        //            $rules += ['code_name'=>'required|unique:coupon_shop_carts',];
        //        }
        return $rules;
    }

    public function messages()
    {
        return [
            'unique' => 'اسم الكود موجود مسبقا',
            'required' => 'هذا الحقل مطلوب',
            'integer' => 'أرقام فقط'
        ];
    }
}
