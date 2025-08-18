<?php

namespace App\Services\Repository\RoleUser;

use App\Services\Repository\FilterFieldMapperInterface;

class RoleUserFilterFieldMapper implements FilterFieldMapperInterface
{
    public function map(array $filters): array
    {
        $mapped = [];

        foreach ($filters as $field => $value) {
            $mapped[$field === 'name' ? "users.$field" : "role_users.$field"] = $value;
        }

        return $mapped;
    }
}
