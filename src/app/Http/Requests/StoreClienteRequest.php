<?php

namespace App\Http\Requests;

use App\Domain\Cliente\Policies\ClientePolicies as P;
use App\Http\Responses\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ApiResponse::error('Erro de validação', 422, $validator->errors())
        );
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
        return [
            'nome' => ['required', 'string', 'max:120'],
            'telefone' => ['required', 'string', 'max:20'],
            'cpf' => ['required', 'digits:'.P::CPF_DIGITS, 'unique:clientes,cpf'],
            'placa_carro' => [
                'required',
                'string',
                'size:'.P::PLACA_SIZE,
                'regex:'.P::PLACA_REGEX,
            ],
        ];
    }
}
