<?php

namespace App\Http\Requests\V1\Tarefa;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateTarefaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->can('update', $this->route('tarefa'));
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

}
