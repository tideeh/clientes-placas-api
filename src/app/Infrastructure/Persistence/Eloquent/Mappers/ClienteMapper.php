<?php

namespace App\Infrastructure\Persistence\Eloquent\Mappers;

use App\Domain\Cliente\Entities\ClienteEntity;
use App\Infrastructure\Persistence\Eloquent\Models\ClienteEloquent;

final class ClienteMapper
{
    public static function toEntity(ClienteEloquent $model): ClienteEntity
    {
        if (! $model) {
            throw new \InvalidArgumentException('Model cannot be null');
        }

        return new ClienteEntity(
            id: $model->id,
            nome: $model->nome,
            telefone: $model->telefone,
            cpf: $model->cpf,
            placa_carro: $model->placa_carro,
            createdAt: $model->created_at?->toDateTimeString(),
            updatedAt: $model->updated_at?->toDateTimeString(),
        );
    }

    public static function toModel(ClienteEntity $entity): ClienteEloquent
    {
        if (! $entity) {
            throw new \InvalidArgumentException('Entity cannot be null');
        }

        $model = new ClienteEloquent;
        $model->id = $entity->id;
        $model->nome = $entity->nome;
        $model->telefone = $entity->telefone;
        $model->cpf = $entity->cpf;
        $model->placa_carro = $entity->placa_carro;

        return $model;
    }

    public static function toArray(array $data): array
    {
        if (! $data) {
            return [];
        }

        return [
            'nome' => $data['nome'],
            'telefone' => $data['telefone'],
            'cpf' => $data['cpf'],
            'placa_carro' => $data['placa_carro'],
        ];
    }
}
