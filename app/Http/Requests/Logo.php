<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Logo extends FormRequest
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
            'logo' => 'required|image|max:2048'
        ];
    }

    /**
     * Get the validation message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'logo.image' => 'File extension must JPG, JPEG, PNG.',
            'logo.required' => 'Logo cant be null',
        ];
    }
}
