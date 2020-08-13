<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    /**
     * Get validation message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Alamat email harus sesuai.',
            'password.min' => 'Password harus lebih dari 6 karakter',
            'password.required' => 'Password harus disi',
        ];
    }
}
