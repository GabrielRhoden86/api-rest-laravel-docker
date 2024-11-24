<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequestDelete extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'exists:fornecedores,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => 'Fornecedor não encontrado.',
        ];
    }
}
