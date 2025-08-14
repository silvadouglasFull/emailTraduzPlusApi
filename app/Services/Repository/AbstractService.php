<?php

namespace App\Services\Repository;

use App\Services\Repository\FilterFieldMapperInterface;

/**
 * @template TFilterMapper of FilterFieldMapperInterface
 */
abstract class AbstractService
{
    /**
     * Fluxo principal para obter registros com filtros
     *
     * @param array<string, mixed> $filters
     * @return array<int, array<string, mixed>>
     */
    public function getAll(array $filters = []): array
    {
        $mappedFilters = $this->mapFilters($filters);

        return $this->repository()->all(
            filters: $mappedFilters,
            resultSpecs: $this->resultSpecifications()
        );
    }

    public function getById(int $id, ?int $user_id = null): mixed
    {
        return $this->repository()->find($id, $user_id);
    }

    public function create(array $data): mixed
    {
        return $this->repository()->create($data);
    }

    public function update(int $id, array $data): mixed
    {
        return $this->repository()->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository()->delete($id);
    }

    // Métodos que cada service concreto deve implementar

    /**
     * @return object Repositório específico do service
     */
    abstract protected function repository(): object;

    /**
     * @return array<string, mixed>
     * @param array<string, mixed> $filters
     */
    abstract protected function mapFilters(array $filters): array;

    /**
     * @return array<int, object> Lista de ResultSpecifications
     */
    abstract protected function resultSpecifications(): array;
}
