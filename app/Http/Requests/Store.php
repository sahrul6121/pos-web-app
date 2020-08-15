<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'admin_id' => 'required',
            'logo' => 'required',
            'name' => 'required',
            'address' => 'required',
        ];
    }

    /**
     * Get the validation message
     */
    public function messages()
    {
        return [
            'admin_id.required' => 'User admin must be created before store.',
            'logo.required' => 'Logo cant be null.',
            'name.required' => 'Name cant be null.',
            'address.required' => 'Address cant be null.',
        ];
    }
}
