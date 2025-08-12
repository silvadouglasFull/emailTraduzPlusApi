<?php

namespace App\Repositories;

use App\Models\RoleUser;

interface RoleUserInterface
{
    public function all(): array;
    public function find(int $id): ?RoleUser;
    public function create(array $data): RoleUser;
    public function update(int $id, array $data): ?RoleUser;
    public function delete(int $id): bool;
}
