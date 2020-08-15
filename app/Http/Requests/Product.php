<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Product extends FormRequest
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
            'name' => 'required',
            'picture' => 'required',
            'stock' => 'required',
            'discount_percentage' => 'required',
            'status' => 'required',
            'price' => 'required',
        ];
    }

    /**
     * Get the validation message
     */
    public function messages()
    {
        return [
            'picture.required' => 'Picture cant be null.',
            'name.required' => 'Name cant be null.',
            'stock.required' => 'Stock cant be null.',
            'discount_percentage.required' => 'Discount percentage cant be null.',
            'status.required' => 'Status cant be null.',
            'price.required' => 'Price cant be null.',
        ];
    }
}
