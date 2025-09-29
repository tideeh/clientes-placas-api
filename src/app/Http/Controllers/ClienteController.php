<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function store(StoreClienteRequest $req) {
        return response()->json(Cliente::create($req->validated()), 201);
    }

    public function update(UpdateClienteRequest $req, int $id) {
        $c = Cliente::findOrFail($id); $c->fill($req->validated())->save(); return response()->json($c);
    }

    public function destroy(int $id) { Cliente::findOrFail($id)->delete(); return response()->noContent(); }

    public function show(int $id) { return response()->json(Cliente::findOrFail($id)); }

    public function byUltimoDigito(string $n) {
        abort_unless(preg_match('/^[0-9]$/',$n),422,'Dígito inválido');
        return response()->json(Cliente::whereRaw('RIGHT(placa_carro,1)=?',[$n])->orderBy('nome')->get());
    }
}
