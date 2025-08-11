<?php

namespace App\Repositories;

use App\Models\Page;

interface PageRepositoryInterface
{
    public function all(): array;
    public function find(int $id): ?Page;
    public function create(array $data): Page;
    public function update(int $id, array $data): ?Page;
    public function delete(int $id): bool;
}
