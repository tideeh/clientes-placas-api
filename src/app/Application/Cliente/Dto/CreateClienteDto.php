<?php

namespace App\Application\Cliente\Dto;

final class CreateClienteDto
{
    public function __construct(
        public string $nome,
        public string $telefone,
        public string $cpf,
        public string $placa_carro) {}

    public static function fromArray(array $a): self
    {
        return new self(
            $a['nome'],
            $a['telefone'],
            $a['cpf'],
            $a['placa_carro']);
    }
}
