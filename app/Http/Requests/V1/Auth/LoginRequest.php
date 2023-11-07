<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => ['required'],
            'email' => ['required', 'email']
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'O campo "password" é obrigatório',
            'email.required' => 'O campo "email" é obrigatório',
            'email.email' => 'O campo "email" deve conter um email válido'
        ];
    }
}
