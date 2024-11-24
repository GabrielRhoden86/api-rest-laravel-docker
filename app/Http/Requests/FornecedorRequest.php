<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'nullable|string|max:40',
            'tipo_documento' => 'nullable|string|in:CPF,CNPJ',
            'contato' => 'nullable|string|max:25',
            'documento' => 'nullable|string|max:18',
            'endereco' => 'nullable|string|max:255',
            'page' => 'nullable|integer|min:1|max:100',
            'orderBy' => 'nullable|string|in:id,nome,tipo_documento,documento,endereco',
            'sort' => 'nullable|string|in:asc,desc',
            'perPage' => 'nullable|integer|min:1|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'orderBy.in' => 'O campo orderBy deve ser um dos seguintes valores: id, nome, tipo_documento, documento, endereco.',
            'sort.in' => 'O campo sort deve ser asc ou desc.',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres.',
            'perPage.integer' => 'O campo perPage deve ser um número inteiro.',
            'perPage.min' => 'Número de registros por página deve ser no mínimo 1.',
            'perPage.max' => 'Número de registros por página não pode ser maior que 100.',
            'documento.max' => 'O campo documento deve ter no máximo 18 caracteres.',
            'contato.max' => 'O campo contato deve ter no máximo 25 caracteres.',
            'contato.string' => 'O campo contato deve ser uma string.',
            'tipo_documento.in' => 'O campo tipo_documento deve ser CPF ou CNPJ.',
            'page.max' => 'O campo página não deve ser maior que 100.',
        ];
    }

    //Garante somente parâmetros válidos no endpoint, adiciona um erro
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $validParams = array_keys($this->rules());
            foreach ($this->all() as $param) {
                if (!in_array($param, $validParams)) {
                    $validator->errors()->add($param, 'Utilize somente os parâmetros válidos: ' . implode(', ', $validParams));
                }
            }
        });
    }
}
