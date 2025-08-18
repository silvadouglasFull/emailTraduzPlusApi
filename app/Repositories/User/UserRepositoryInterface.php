<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param array<string, mixed>             $filters Optional simple filters
     * @param array<int, ResultSpecification>  $resultSpecs Result transformers (e.g., date formatting)
     * @return array<int, array<string, mixed>>
     */
    public function all(array $filters = [], array $resultSpecs = []): array;
    public function find(int $id, ?int $user_id): ?User;
    public function create(array $data): User;
    public function update(int $id, array $data): ?User;
    public function delete(int $id): bool;
}
