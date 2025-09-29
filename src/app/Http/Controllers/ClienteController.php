<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use App\Http\Responses\ApiResponse;

class ClienteController extends Controller
{
	public function store(StoreClienteRequest $req)
	{
		$c = Cliente::create($req->validated());
		return ApiResponse::created($c, 'Cliente criado');
	}

	public function update(UpdateClienteRequest $req, int $id)
	{
		$c = Cliente::findOrFail($id);
		$c->fill($req->validated())->save();
		return ApiResponse::ok($c, 'Cliente atualizado');
	}

	public function destroy(int $id)
	{
		Cliente::findOrFail($id)->delete();
		return ApiResponse::noContent();
	}

	public function show(int $id)
	{
		return ApiResponse::ok(Cliente::findOrFail($id));
	}

	public function byUltimoDigito(string $n)
	{
		abort_unless(preg_match('/^[0-9]$/', $n), 422, 'Dígito inválido');
		return ApiResponse::ok(Cliente::whereRaw('RIGHT(placa_carro,1)=?', [$n])->orderBy('nome')->get());
	}
}
