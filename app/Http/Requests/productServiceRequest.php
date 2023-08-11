<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productServiceRequest extends FormRequest
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
            'services' => 'required',
            'price' => 'required|numeric',
            'priceUrgent' => 'numeric',
            'commission' => 'required'
        ];
    }

    public function  messages()
    {
        return [
            'regex' => 'هذا الحقل يقبل حروف فقط',
            'required' => 'هذا الحقل مطلوب',
            'numeric' => 'هذا الحقل يقبل أرقام فقط'
        ];
    }
}
