<?php

namespace App\Services;

use App\Repositories\EmailRepositoryInterface;
use App\Models\Email;

class EmailService
{
    private EmailRepositoryInterface $repository;

    public function __construct(EmailRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): array
    {
        return $this->repository->all();
    }

    public function getById(int $id): ?Email
    {
        return $this->repository->find($id);
    }

    public function create(array $data): Email
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): ?Email
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
