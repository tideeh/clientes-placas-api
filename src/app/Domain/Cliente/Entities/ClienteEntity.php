<?php

namespace App\Domain\Cliente\Entities;

final class ClienteEntity
{
    public function __construct(
        public readonly int $id,
        public string $nome,
        public string $telefone,
        public string $cpf,
        public string $placa_carro,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {}
}
