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

        $rules= [
            'code_name'=>'required|unique:coupon_shop_carts',
            'discount_value'=>'required',
            'date_from'=>'required',
            'date_to'=>'required',
            'status'=>'required',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ['code_name'=>'required|unique:coupon_shop_carts',];
        }elseif ($this->getMethod() == 'PATCH'){
            $rules += ['code_name'=>'required|unique:coupon_shop_carts',];
        }
        return $rules;

    }
//    public function store(){
//        return [
//            'code_name'=>'required|unique:coupon_shop_carts',
//            'discount_value'=>'required',
//            'date_from'=>'required',
//            'date_to'=>'required',
//            'status'=>'required',
//        ];
//    }
//    public function update(){
//        return [
//            'code_name'=>'required|unique:coupon_shop_carts,'.$this->id,
//            'discount_value'=>'required',
//            'date_from'=>'required',
//            'date_to'=>'required',
//            'status'=>'required',
//        ];
//    }
    public function messages()
    {
        return [
            'unique'=>'اسم الكود موجود مسبقا',
            'required'=>'هذا الحقل مطلوب'
        ];
    }
}
