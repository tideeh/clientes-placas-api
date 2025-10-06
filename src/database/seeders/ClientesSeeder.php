<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Eloquent\Models\ClienteEloquent;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        $dados = [
            ['nome' => 'Ana Souza',      'telefone' => '11999990001', 'cpf' => '13712495048', 'placa_carro' => 'ABC1D23'],
            ['nome' => 'Bruno Lima',     'telefone' => '21988887772', 'cpf' => '19239917012', 'placa_carro' => 'DEF2G34'],
            ['nome' => 'Carla Mota',     'telefone' => '31977776663', 'cpf' => '87798930078', 'placa_carro' => 'GHI3J45'],
            ['nome' => 'Diego Santos',   'telefone' => '11966665554', 'cpf' => '51945013079', 'placa_carro' => 'JKL4M56'],
            ['nome' => 'Eva Ribeiro',    'telefone' => '51955554443', 'cpf' => '70373438036', 'placa_carro' => 'MNO5P67'],
            ['nome' => 'Fábio Silva',    'telefone' => '31944443332', 'cpf' => '42930214007', 'placa_carro' => 'PQR6S78'],
            ['nome' => 'Gustavo Nunes',  'telefone' => '21933332221', 'cpf' => '63234463085', 'placa_carro' => 'STU7V89'],
            ['nome' => 'Helena Prado',   'telefone' => '11922221110', 'cpf' => '53526287015', 'placa_carro' => 'VWX8Y10'],
            ['nome' => 'Igor Almeida',   'telefone' => '41911110009', 'cpf' => '26717742062', 'placa_carro' => 'YZA9B11'],
            ['nome' => 'Júlia Costa',    'telefone' => '61900009998', 'cpf' => '43896607057', 'placa_carro' => 'BCD0E12'],
        ];

        foreach ($dados as $c) {
            ClienteEloquent::updateOrCreate(['cpf' => $c['cpf']], $c);
        }
    }
}
