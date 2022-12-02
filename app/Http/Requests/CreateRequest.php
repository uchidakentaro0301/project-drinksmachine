<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'company_id' => 'required | numeric',
            'product_name' => 'required',
            'price' =>'required | numeric',
            'stock'=> 'required | numeric',
            // 'comment' => 'required'
        ];
    }
    
    public function messages() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'price.max' => ':attributeは必須項目です。',
            'stock.max' => ':attributeは必須項目です。',
            'comment.max' => ':attributeは:max字以内で入力してください。',
        ];
    }
}

