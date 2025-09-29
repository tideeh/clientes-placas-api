<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest {
  public function authorize(): bool { return true; }
  public function rules(): array {
    return [
      'nome' => ['required','string','max:120'],
      'telefone'=> ['required','string','max:20','regex:/^[0-9()+ \-]+$/'],
      'cpf'  => ['required','digits:11','unique:clientes,cpf'],
      'placa_carro' => ['required','string','max:7',
        'regex:/^([A-Z]{3}[0-9]{4}|[A-Z]{3}[0-9][A-Z][0-9]{2})$/'],
    ];
  }
}
