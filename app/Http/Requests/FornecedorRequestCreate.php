<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FornecedorRequestCreate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:40',
            'documento' => [
                'required',
                'string',
                'max:18',
                Rule::when(
                    $this->input('tipo_documento') === 'CPF',
                    function () {
                        return 'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/';
                    }
                ),
                Rule::when(
                    $this->input('tipo_documento') === 'CNPJ',
                    function () {
                        return 'regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/';
                    }
                ),
            ],
            'tipo_documento' => 'required|string|in:CPF,CNPJ',
            'contato' => 'required|string|max:255',
            'endereco' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.max' => 'O campo nome não pode exceder 255 caracteres.',

            'documento.required' => 'O campo documento é obrigatório.',
            'documento.string' => 'O campo documento deve ser uma string.',
            'documento.max' => 'O campo documento não pode exceder 18 caracteres.',
            'documento.regex' => "O campo documento deve estar no formato correto: CPF(000.000.000-00) ou CNPJ(00.00.000/0001-00).",

            'tipo_documento.required' => 'O campo tipo de documento é obrigatório.',
            'tipo_documento.string' => 'O campo tipo de documento deve ser uma string.',
            'tipo_documento.in' => 'O campo tipo de documento deve ser CPF ou CNPJ.',

            'contato.required' => 'O campo contato é obrigatório.',
            'contato.string' => 'O campo contato deve ser uma string.',
            'contato.max' => 'O campo contato não pode exceder 255 caracteres.',

            'endereco' => 'O campo endereço é obrigatório.',
            'endereco.string' => 'O campo endereço deve ser uma string.',
            'endereco.max' => 'O campo endereço não pode exceder 255 caracteres.',
        ];
    }
}
