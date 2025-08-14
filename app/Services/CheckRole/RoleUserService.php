<?php

namespace App\Services\CheckRole;

use App\Repositories\RoleUserInterface;
use App\Models\RoleUser;

class RoleUserService
{
    private RoleUserInterface $repository;

    public function __construct(RoleUserInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): array
    {
        return $this->repository->all();
    }

    public function getById(int $id): ?RoleUser
    {
        return $this->repository->find($id);
    }

    public function create(array $data): RoleUser
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): ?RoleUser
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
