<?php

namespace App\Domain\Cliente\Policies;

final class ClientePolicies
{
    public const PLACA_REGEX = '/^(?:[A-Z]{3}\d{4}|[A-Z]{3}\d[A-Z]\d{2})$/';

    public const CPF_DIGITS = 11;

    public const PLACA_SIZE = 7;
}
