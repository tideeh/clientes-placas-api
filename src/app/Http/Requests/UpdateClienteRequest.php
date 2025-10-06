<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $cpf = preg_replace('/\D/', '', (string) $this->input('cpf'));
        $tel = preg_replace('/\D/', '', (string) $this->input('telefone'));
        $placa = strtoupper((string) $this->input('placa_carro'));

        $this->merge([
            'cpf' => $cpf,
            'telefone' => $tel,
            'placa_carro' => $placa,
        ]);
    }

    public function rules(): array
    {
        $id = (int) $this->route('id');

        return [
            'nome' => ['sometimes', 'string', 'max:120'],
            'telefone' => ['sometimes', 'string', 'max:20'],
            'cpf' => [
                'sometimes',
                'digits:11',
                Rule::unique('clientes', 'cpf')->ignore($id),
            ],
            'placa_carro' => [
                'sometimes',
                'string',
                'size:7',
                'regex:/^(?:[A-Z]{3}\d{4}|[A-Z]{3}\d[A-Z]\d{2})$/',
            ],
        ];
    }
}
