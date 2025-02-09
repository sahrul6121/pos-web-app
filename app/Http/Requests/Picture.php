<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Picture extends FormRequest
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
            'picture' => 'required|image|max:2048'
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
            'picture.image' => 'File extension must JPG, JPEG, PNG.',
            'picture.required' => 'Picture cant be null',
        ];
    }
}
