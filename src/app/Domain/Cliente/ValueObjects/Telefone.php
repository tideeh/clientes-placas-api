<?php

namespace App\Domain\Cliente\ValueObjects;

final class Telefone
{
    public readonly string $value;

    public function __construct(string $v)
    {
        $digits = preg_replace('/\D/', '', $v);

        if (strlen($digits) < 8 || strlen($digits) > 13) {
            throw new \DomainException('Telefone inválido');
        }

        $this->value = $digits;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
