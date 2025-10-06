<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Cliente\Entities\ClienteEntity;
use App\Domain\Cliente\Repositories\ClienteRepository;
use App\Infrastructure\Persistence\Eloquent\Mappers\ClienteMapper;
use App\Infrastructure\Persistence\Eloquent\Models\ClienteEloquent;

final class EloquentClienteRepository implements ClienteRepository
{
    public function create(array $d): ClienteEntity
    {
        return ClienteMapper::toEntity(ClienteEloquent::create($d));
    }

    public function find(int $id): ?ClienteEntity
    {
        $m = ClienteEloquent::find($id);

        return $m ? ClienteMapper::toEntity($m) : null;
    }

    public function update(ClienteEntity $e, array $d): ClienteEntity
    {
        $m = ClienteEloquent::findOrFail($e->id);
        $m->fill($d)->save();

        return ClienteMapper::toEntity($m);
    }

    public function delete(ClienteEntity $e): void
    {
        ClienteEloquent::whereKey($e->id)->delete();
    }

    public function findByCpf(string $cpf): ?ClienteEntity
    {
        $m = ClienteEloquent::where('cpf', $cpf)->first();

        return $m ? ClienteMapper::toEntity($m) : null;
    }

    public function findByPlateLastDigit(string $n): array
    {
        return ClienteEloquent::query()
            ->whereRaw('SUBSTR(placa_carro, -1) = ?', [$n])
            ->orderBy('nome')
            ->get()
            ->map(fn ($m) => ClienteMapper::toEntity($m))
            ->all();
    }
}
