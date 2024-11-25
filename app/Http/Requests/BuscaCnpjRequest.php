<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class BuscaCnpjRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cnpj' => 'required|regex:/^\d{14}$/'
        ];
    }

    public function messages(): array
    {
        return [
            'cnpj.required' => 'O campo CNPJ é obrigatório.',
            'cnpj.regex' => 'O campo CNPJ deve ter 14 dígitos sem formatação.'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cnpj' => $this->route('cnpj'),
        ]);
    }
}
