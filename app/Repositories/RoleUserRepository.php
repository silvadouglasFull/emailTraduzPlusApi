<?php

namespace App\Repositories;

use App\Models\RoleUser;

class RoleUserRepository implements RoleUserInterface
{
    public function all(): array
    {
        return RoleUser::all()->toArray();
    }

    public function find(int $id): ?RoleUser
    {
        return RoleUser::find($id);
    }

    public function create(array $data): RoleUser
    {
        return RoleUser::create($data);
    }

    public function update(int $id, array $data): ?RoleUser
    {
        $RoleUser = RoleUser::find($id);
        if (!$RoleUser) {
            return null;
        }

        $RoleUser->update($data);
        return $RoleUser;
    }

    public function delete(int $id): bool
    {
        $RoleUser = RoleUser::find($id);
        return $RoleUser ? $RoleUser->delete() : false;
    }
}
