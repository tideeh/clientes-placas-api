<?php

namespace App\Domain\Cliente\ValueObjects;

final class Placa
{
    public function __construct(public string $value)
    {
        $v = strtoupper($this->value);
        if (! (preg_match('/^[A-Z]{3}\d{4}$/', $v) || preg_match('/^[A-Z]{3}\d[A-Z]\d{2}$/', $v))) {
            throw new \DomainException('Placa inválida');
        }

        $this->value = $v;
    }
}
