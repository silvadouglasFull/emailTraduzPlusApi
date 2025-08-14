<?php

namespace App\Repositories\Pages;

use App\Models\Page;

interface PageRepositoryInterface
{
    /**
     * @param array<string, mixed>             $filters Optional simple filters
     * @param array<int, ResultSpecification>  $resultSpecs Result transformers (e.g., date formatting)
     * @return array<int, array<string, mixed>>
     */
    public function all(array $filters = [], array $resultSpecs = []): array;
    public function find(int $id, ?int $user_id): ?Page;
    public function create(array $data): Page;
    public function update(int $id, array $data): ?Page;
    public function delete(int $id): bool;
}
