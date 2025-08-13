<?php

namespace App\Services\Page;

use App\Repositories\PageRepositoryInterface;
use App\Models\Page;
use App\Services\FilterFieldMapperInterface;
use App\Specifications\FormatBrazilianDateSpecification;

class PageService
{
    private PageRepositoryInterface $repository;
    private FilterFieldMapperInterface $filterFieldMapper;
    public function __construct(
        PageRepositoryInterface $repository,
        FilterFieldMapperInterface $filterFieldMapper
    ) {
        $this->repository = $repository;
        $this->filterFieldMapper = $filterFieldMapper;
    }
    /**
     * @param array<string, mixed> $filters Optional simple filters
     * @return array<int, array<string, mixed>>
     */
    public function getAll(array $filters = []): array
    {
        return $this->repository->all(
            filters: $this->filterFieldMapper->map($filters),
            resultSpecs: [
                new FormatBrazilianDateSpecification(['created_at', 'updated_at']),
            ]
        );
    }

    public function getById(int $id, ?int $user_id): ?Page
    {
        return $this->repository->find($id, $user_id);
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
