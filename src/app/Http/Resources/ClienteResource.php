<?php

namespace App\Http\Resources;

use App\Domain\Cliente\Entities\ClienteEntity;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/** @extends JsonResource<ClienteEntity> */
final class ClienteResource extends JsonResource
{
    public function __construct(ClienteEntity $resource)
    {
        parent::__construct($resource);
    }

    /** @return array<string,mixed> */
    public function toArray($request): array
    {
        $c = $this->resource;

        return [
            'id' => $c->id,
            'nome' => $c->nome,
            'telefone' => $c->telefone,
            'cpf' => $c->cpf,
            'placa_carro' => $c->placa_carro,
            'criado_em' => $c->createdAt,
            'atualizado_em' => $c->updatedAt,
        ];
    }

    /** @param iterable<ClienteEntity> $resource */
    public static function collection($resource): AnonymousResourceCollection
    {
        return parent::collection($resource);
    }
}
