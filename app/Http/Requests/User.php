<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class User extends FormRequest
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
            'avatar' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'status' => 'required',
            'role_id' => 'required',
        ];
    }

    /**
     * Get the validation message
     */
    public function messages()
    {
        return [
            'avatar.required' => 'Avatar cant be null.',
            'username.required' => 'Username cant be null.',
            'email.required' => 'Email cant be null.',
            'email.email' => 'Email must valid.',
            'password.required' => 'Password cant be null.',
            'status.required' => 'Status cant be null.',
            'role_id.required' => 'Role cant be null.',
        ];
    }
}
