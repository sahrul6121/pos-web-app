<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Avatar extends FormRequest
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
            'avatar' => 'required|image|max:2048'
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
            'avatar.image' => 'File extension must JPG, JPEG, PNG.',
            'avatar.required' => 'Avatar cant be null',
        ];
    }
}
