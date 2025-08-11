<?php

namespace App\Services;

use App\Repositories\PageRepositoryInterface;
use App\Models\Page;

class PageService
{
    private PageRepositoryInterface $repository;

    public function __construct(PageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): array
    {
        return $this->repository->all();
    }

    public function getById(int $id): ?Page
    {
        return $this->repository->find($id);
    }

    public function create(array $data): Page
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): ?Page
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
