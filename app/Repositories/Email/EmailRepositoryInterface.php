<?php

namespace App\Repositories\Email;

use App\Models\Email;

interface EmailRepositoryInterface
{
    /**
     * @param array<string, mixed>             $filters Optional simple filters
     * @param array<int, ResultSpecification>  $resultSpecs Result transformers (e.g., date formatting)
     * @return array<int, array<string, mixed>>
     */
    public function all(array $filters = [], array $resultSpecs = []): array;
    public function find(int $id, ?int $user_id): ?Email;
    public function create(array $data): Email;
    public function update(int $id, array $data): ?Email;
    public function delete(int $id): bool;
}
