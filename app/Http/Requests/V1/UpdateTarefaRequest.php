<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTarefaRequest extends FormRequest
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
            'nome' => ['sometimes', 'max:50', 'max:50', 'regex:/\S/'],
            'concluida' => ['sometimes', Rule::in([true, false, 0, 1])]
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo "nome" é obrigatório',
            'nome.regex' => 'O campo "nome" não pode estar em branco',
            'nome.max' => 'O campo "nome" deve conter no máximo 50 caracteres',
            'concluida.in' => 'O campo "concluida" deve ser 0 ou 1'
        ];
    }
}
