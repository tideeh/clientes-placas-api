<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('POST /api/cliente cria e normaliza cpf/placa', function () {
    $payload = [
        'nome' => 'Ana Souza',
        'telefone' => '(11) 99999-1111',
        'cpf' => '390.533.447-05',
        'placa_carro' => 'abc1d23',
    ];

    $res = $this->postJson('/api/cliente', $payload)->assertCreated();
    $res->assertJsonPath('data.cpf', '39053344705');
    $res->assertJsonPath('data.placa_carro', 'ABC1D23');
});

it('GET /api/cliente/{id} 404 quando não existe', function () {
    $this->getJson('/api/cliente/999')->assertNotFound();
});

it('PUT /api/cliente atualiza telefone', function () {
    $payload = [
        'nome' => 'Ana Souza',
        'telefone' => '(11) 99999-1111',
        'cpf' => '390.533.447-05',
        'placa_carro' => 'ABC1D23',
    ];

    $this->postJson('/api/cliente', $payload)->assertCreated();

    $payload['telefone'] = '(11) 99999-2222';

    $this->putJson('/api/cliente/1', $payload)
        ->assertOk()
        ->assertJsonPath('data.telefone', '11999992222');
});

it('PUT /api/cliente valida unicidade de cpf no update', function () {
    $payload1 = [
        'nome' => 'A',
        'telefone' => '(11) 99999-1111',
        'cpf' => '15350946056',
        'placa_carro' => 'ABC1234',
    ];

    $payload2 = [
        'nome' => 'B',
        'telefone' => '(11) 99999-2222',
        'cpf' => '39053344705',
        'placa_carro' => 'ABC1D23',
    ];

    $this->postJson('/api/cliente', $payload1)->assertCreated();
    $this->postJson('/api/cliente', $payload2)->assertCreated();

    $this->putJson('/api/cliente/2', $payload1)
        ->assertStatus(422);
});

it('DELETE /api/cliente/{id} remove e retorna 204', function () {
    $payload = [
        'nome' => 'Ana',
        'telefone' => '(11) 99999-1111',
        'cpf' => '39053344705',
        'placa_carro' => 'ABC1D23',
    ];

    $this->postJson('/api/cliente', $payload)->assertCreated();

    $this->deleteJson('/api/cliente/1')->assertNoContent();

    $this->getJson('/api/cliente/1')->assertNotFound();
});

it('DELETE /api/cliente/{id} 404 quando não existe', function () {
    $this->deleteJson('/api/cliente/999')->assertNotFound();
});

it('GET /api/consulta/final-placa/{n} retorna lista por dígito final', function () {
    $this->postJson('/api/cliente', [
        'nome' => 'A', 'telefone' => '(11) 99999-1111', 'cpf' => '15350946056', 'placa_carro' => 'ABC1D23',
    ])->assertCreated();

    $this->postJson('/api/cliente', [
        'nome' => 'B', 'telefone' => '(11) 99999-2222', 'cpf' => '39053344705', 'placa_carro' => 'DEF2G34',
    ])->assertCreated();

    $this->getJson('/api/consulta/final-placa/3')
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.placa_carro', 'ABC1D23');
});

it('GET /api/consulta/final-placa/{n} valida dígito inválido', function () {
    $this->getJson('/api/consulta/final-placa/x')->assertStatus(422);
    $this->getJson('/api/consulta/final-placa/12')->assertStatus(422);
});
