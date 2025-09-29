<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        $dados = [
            ['nome'=>'Ana Souza',      'telefone'=>'11999990001','cpf'=>'12345678901','placa_carro'=>'ABC1D23'],
            ['nome'=>'Bruno Lima',     'telefone'=>'21988887772','cpf'=>'12345678902','placa_carro'=>'DEF2G34'],
            ['nome'=>'Carla Mota',     'telefone'=>'31977776663','cpf'=>'12345678903','placa_carro'=>'GHI3J45'],
            ['nome'=>'Diego Santos',   'telefone'=>'11966665554','cpf'=>'12345678904','placa_carro'=>'JKL4M56'],
            ['nome'=>'Eva Ribeiro',    'telefone'=>'51955554443','cpf'=>'12345678905','placa_carro'=>'MNO5P67'],
            ['nome'=>'Fábio Silva',    'telefone'=>'31944443332','cpf'=>'12345678906','placa_carro'=>'PQR6S78'],
            ['nome'=>'Gustavo Nunes',  'telefone'=>'21933332221','cpf'=>'12345678907','placa_carro'=>'STU7V89'],
            ['nome'=>'Helena Prado',   'telefone'=>'11922221110','cpf'=>'12345678908','placa_carro'=>'VWX8Y10'],
            ['nome'=>'Igor Almeida',   'telefone'=>'41911110009','cpf'=>'12345678909','placa_carro'=>'YZA9B11'],
            ['nome'=>'Júlia Costa',    'telefone'=>'61900009998','cpf'=>'12345678910','placa_carro'=>'BCD0E12'],
        ];

        foreach ($dados as $c) {
            Cliente::updateOrCreate(['cpf' => $c['cpf']], $c);
        }
    }
}
