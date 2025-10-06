<?php

use App\Application\Cliente\Dto\CreateClienteDto;
use App\Application\Cliente\Services\ClienteService;
use App\Domain\Cliente\Entities\ClienteEntity;
use App\Domain\Cliente\Repositories\ClienteRepository;

it('cria cliente validando cpf e placa', function () {
    $repo = Mockery::mock(ClienteRepository::class);
    $cpf = '39053344705';

    $dto = new CreateClienteDto(
        nome: 'Ana',
        telefone: '11999999999',
        cpf: $cpf,
        placa_carro: 'ABC1D23'
    );

    $repo->shouldReceive('findByCpf')->with($cpf)->once()->andReturn(null);
    $repo->shouldReceive('create')->once()->with((array) $dto)->andReturn(
        new ClienteEntity(1, $dto->nome, $dto->telefone, $dto->cpf, $dto->placa_carro)
    );

    $service = new ClienteService($repo);
    $c = $service->criar($dto);

    expect($c->id)->toBe(1)->and($c->cpf)->toBe($cpf);
});

it('falha ao criar com cpf duplicado', function () {
    $repo = Mockery::mock(ClienteRepository::class);
    $cpf = '39053344705';

    $dto = new CreateClienteDto('Ana', '(11) 99999-1111', $cpf, 'ABC1D23');

    $repo->shouldReceive('findByCpf')->andReturn(
        new ClienteEntity(1, 'Ana', '(11) 99999-1111', $cpf, 'ABC1D23')
    );

    $service = new ClienteService($repo);
    $service->criar($dto);
})->throws(DomainException::class, 'CPF já cadastrado');

it('atualiza cliente validando campos alterados', function () {
    $repo = Mockery::mock(ClienteRepository::class);
    $cpf = '39053344705';

    $existente = new ClienteEntity(1, 'Ana', '(11) 99999-1111', $cpf, 'ABC1D23');
    $repo->shouldReceive('find')->with(1)->andReturn($existente);
    $repo->shouldReceive('findByCpf')->never();
    $repo->shouldReceive('update')->once()->andReturn(
        new ClienteEntity(1, 'Ana', '(11) 99999-2222', $cpf, 'ABC1D23')
    );

    $service = new ClienteService($repo);
    $c = $service->atualizar(1, ['telefone' => '(11) 99999-2222']);

    expect($c->telefone)->toBe('(11) 99999-2222');
});

it('remove cliente por id', function () {
    $repo = Mockery::mock(ClienteRepository::class);

    $repo->shouldReceive('find')->with(2)->andReturn(new ClienteEntity(2, 'B', '1', '15350946056', 'ABC1234'));
    $repo->shouldReceive('delete')->once();

    $service = new ClienteService($repo);
    expect($service->remover(2))->toBeTrue();
});

it('remover retorna false quando não existe', function () {
    $repo = Mockery::mock(ClienteRepository::class);

    $repo->shouldReceive('find')->with(99)->andReturn(null);

    $service = new ClienteService($repo);
    expect($service->remover(99))->toBeFalse();
});
