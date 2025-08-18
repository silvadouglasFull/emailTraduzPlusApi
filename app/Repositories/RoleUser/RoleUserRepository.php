<?php

namespace App\Repositories\RoleUser;

use App\Models\RoleUser;
use App\Repositories\BaseRepository;
use App\Utils\Dates\DateValidator;
use App\Utils\PaginationHelper;

class RoleUserRepository extends BaseRepository implements RoleUserRepositoryInterface
{
    public function all(array $filters = [], array $resultSpecs = []): array
    {
        $query = RoleUser::select(
            'role_users.role',
            'role_users.created_at',
            'users.name',
        )->join(
            'users',
            'users.id',
            '=',
            'role_users.users_id'
        );
        foreach ($filters as $field => $value) {
            if (in_array($field, [
                'role_users.role',
                'role_users.users_id',
                'role_users.created_at',
                'users.name'
            ], true)) {
                $query->when(is_string($value) && (!DateValidator::isValidDate($value)), function ($query) use ($field, $value) {
                    return $query->where($field, "LIKE", "%$value%");
                })
                    ->when(is_numeric($value), function ($query) use ($field, $value) {
                        return $query->where($field, $value);
                    });
            }
        }
        $result = $query->paginate()->toArray();
        return array_merge(
            ["data" => $this->applyResultSpecs($result["data"], $resultSpecs)],
            PaginationHelper::extract($result)
        );
    }

    public function find(int $id, ?int $user_id): ?RoleUser
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
