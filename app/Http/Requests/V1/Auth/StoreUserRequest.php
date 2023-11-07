<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'max:50', 'regex:/\S/'],
            'password' => ['required', 'max:50'],
            'email' => ['required', 'email']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo "name" é obrigatório',
            'name.regex' => 'O campo "name" não pode estar em branco',
            'name.max' => 'O campo "name" deve conter no máximo 50 caracteres',
            'password.required' => 'O campo "password" é obrigatório',
            'password.max' => 'O campo "password" deve conter no máximo 50 caracteres',
            'email.required' => 'O campo "email" é obrigatório',
            'email.email' => 'O campo "email" deve conter um email válido'
        ];
    }
}
