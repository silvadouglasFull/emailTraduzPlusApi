<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Utils\Dates\DateValidator;
use App\Utils\PaginationHelper;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function all(array $filters = [], array $resultSpecs = []): array
    {
        $query = User::select(
            'users.name',
            'users.email',
            'users.created_at'
        );
        foreach ($filters as $field => $value) {
            if (in_array($field, [
                'users.name',
                'users.email',
                'users.created_at'
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

    public function find(int $id, ?int $user_id): ?User
    {
        return User::find($id);
    }

    public function create(array $data): User
    {
        $password = Hash::make($data["password"]);
        $data["password"] = $password;
        return User::create($data);
    }

    public function update(int $id, array $data): ?User
    {
        $User = User::find($id);
        if (!$User) {
            return null;
        }

        $User->update($data);
        return $User;
    }

    public function delete(int $id): bool
    {
        $User = User::find($id);
        return $User ? $User->delete() : false;
    }
}
