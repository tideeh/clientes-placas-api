<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteEloquent extends Model
{
    protected $table = 'clientes';

    protected $fillable = ['nome', 'telefone', 'cpf', 'placa_carro'];
}
