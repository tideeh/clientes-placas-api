<?php

namespace App\Application\Cliente\Services;

use App\Application\Cliente\Dto\CreateClienteDto;
use App\Domain\Cliente\Entities\ClienteEntity;
use App\Domain\Cliente\Repositories\ClienteRepository;
use App\Domain\Cliente\ValueObjects\Cpf;
use App\Domain\Cliente\ValueObjects\Placa;
use App\Domain\Cliente\ValueObjects\Telefone;

final class ClienteService
{
    public function __construct(private ClienteRepository $repo) {}

    public function criar(CreateClienteDto $dto): ClienteEntity
    {
        new Telefone($dto->telefone);
        new Cpf($dto->cpf);
        new Placa($dto->placa_carro);

        if ($this->repo->findByCpf($dto->cpf)) {
            throw new \DomainException('CPF já cadastrado');
        }

        return $this->repo->create((array) $dto);
    }

    public function atualizar(int $id, array $data): ?ClienteEntity
    {
        $c = $this->repo->find($id);
        if (! $c) {
            return null;
        }

        if (array_key_exists('telefone', $data)) {
            new Telefone($data['telefone']);
        }
        if (array_key_exists('cpf', $data)) {
            new Cpf($data['cpf']);
        }
        if (array_key_exists('placa_carro', $data)) {
            new Placa($data['placa_carro']);
        }

        if (isset($data['cpf']) && $data['cpf'] !== $c->cpf) {
            if ($this->repo->findByCpf($data['cpf'])) {
                throw new \DomainException('CPF já cadastrado');
            }
        }

        return $this->repo->update($c, $data);
    }

    public function remover(int $id): bool
    {
        $c = $this->repo->find($id);
        if (! $c) {
            return false;
        }

        $this->repo->delete($c);

        return true;
    }

    public function buscar(int $id): ?ClienteEntity
    {
        return $this->repo->find($id);
    }

    public function buscarPorUltimoDigito(string $n): iterable
    {
        return $this->repo->findByPlateLastDigit($n);
    }
}
