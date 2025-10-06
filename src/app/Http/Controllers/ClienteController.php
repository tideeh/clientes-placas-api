<?php

namespace App\Http\Controllers;

use App\Application\Cliente\Dto\CreateClienteDto;
use App\Application\Cliente\Services\ClienteService;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Http\Resources\ClienteResource;

class ClienteController
{
    public function store(StoreClienteRequest $req, ClienteService $service)
    {
        $c = $service->criar(CreateClienteDto::fromArray($req->validated()));

        return (new ClienteResource($c))->response()->setStatusCode(201);
    }

    public function update(UpdateClienteRequest $req, int $id, ClienteService $service)
    {
        $c = $service->atualizar($id, $req->validated());
        if (! $c) {
            return response()->json(['success' => false, 'message' => 'Recurso não encontrado'], 404);
        }

        return (new ClienteResource($c))->response()->setStatusCode(200);
    }

    public function destroy(int $id, ClienteService $service)
    {
        $ok = $service->remover($id);

        return $ok
            ? response()->noContent()
            : response()->json(['success' => false, 'message' => 'Recurso não encontrado'], 404);
    }

    public function show(int $id, ClienteService $service)
    {
        $c = $service->buscar($id);

        return $c
            ? new ClienteResource($c)
            : response()->json(['success' => false, 'message' => 'Recurso não encontrado'], 404);
    }

    public function byUltimoDigito(string $n, ClienteService $service)
    {
        if (! preg_match('/^\d$/', $n)) {
            return response()->json(['success' => false, 'message' => 'Dígito inválido'], 422);
        }

        $list = $service->buscarPorUltimoDigito($n);

        return ClienteResource::collection($list)->response()->setStatusCode(200);
    }
}
