<?php

namespace App\Repositories\RoleUser;

use App\Models\RoleUser;

interface RoleUserRepositoryInterface
{
    /**
     * @param array<string, mixed>             $filters Optional simple filters
     * @param array<int, ResultSpecification>  $resultSpecs Result transformers (e.g., date formatting)
     * @return array<int, array<string, mixed>>
     */
    public function all(array $filters = [], array $resultSpecs = []): array;
    public function find(int $id, ?int $user_id): ?RoleUser;
    public function create(array $data): RoleUser;
    public function update(int $id, array $data): ?RoleUser;
    public function delete(int $id): bool;
}
