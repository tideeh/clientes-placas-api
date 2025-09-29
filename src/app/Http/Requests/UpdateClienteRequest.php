<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest {
  public function authorize(): bool { return true; }
  public function rules(): array {
    $id = $this->route('id');
    return [
      'nome' => ['sometimes','string','max:120'],
      'telefone'=> ['sometimes','string','max:20','regex:/^[0-9()+ \-]+$/'],
      'cpf'  => ['sometimes','digits:11',"unique:clientes,cpf,{$id}"],
      'placa_carro' => ['sometimes','string','max:7',
        'regex:/^([A-Z]{3}[0-9]{4}|[A-Z]{3}[0-9][A-Z][0-9]{2})$/'],
    ];
  }
}
