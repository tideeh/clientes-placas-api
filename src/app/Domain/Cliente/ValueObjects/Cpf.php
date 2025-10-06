<?php

namespace App\Domain\Cliente\ValueObjects;

final class Cpf
{
    public readonly string $value;

    public function __construct(string $v)
    {
        $digits = preg_replace('/\D/', '', $v);

        if (! preg_match('/^\d{11}$/', $digits) || self::isInvalid($digits)) {
            throw new \DomainException('CPF inválido');
        }

        $this->value = $digits;
    }

    private static function isInvalid(string $v): bool
    {
        if (preg_match('/^(.)\1{10}$/', $v)) {
            return true;
        }

        $dv = function (string $base, int $factor): int {
            $sum = 0;
            for ($i = 0; $i < strlen($base); $i++, $factor--) {
                $sum += intval($base[$i]) * $factor;
            }
            $rest = $sum % 11;

            return $rest < 2 ? 0 : 11 - $rest;
        };

        return
            $v[9] != (string) $dv(substr($v, 0, 9), 10)
            || $v[10] != (string) $dv(substr($v, 0, 10), 11);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
