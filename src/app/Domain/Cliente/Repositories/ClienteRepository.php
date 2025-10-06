<?php

namespace App\Domain\Cliente\Repositories;

use App\Domain\Cliente\Entities\ClienteEntity;

interface ClienteRepository
{
    public function create(array $data): ClienteEntity;

    public function find(int $id): ?ClienteEntity;

    public function update(ClienteEntity $c, array $data): ClienteEntity;

    public function delete(ClienteEntity $c): void;

    public function findByCpf(string $cpf): ?ClienteEntity;

    public function findByPlateLastDigit(string $n): array;
}
