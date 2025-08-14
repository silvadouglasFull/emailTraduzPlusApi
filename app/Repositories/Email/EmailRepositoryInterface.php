<?php

namespace App\Repositories\Email;

use App\Models\Email;

interface EmailRepositoryInterface
{
    public function all(): array;
    public function find(int $id): ?Email;
    public function create(array $data): Email;
    public function update(int $id, array $data): ?Email;
    public function delete(int $id): bool;
}
