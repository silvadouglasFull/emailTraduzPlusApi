<?php

namespace App\Services\Repository\Email;

use App\Services\Repository\FilterFieldMapperInterface;

class EmailFilterFieldMapper implements FilterFieldMapperInterface
{
    public function map(array $filters): array
    {
        $mapped = [];

        foreach ($filters as $field => $value) {
            $mapped[$field === 'name' ? "users.$field" : "email.$field"] = $value;
        }

        return $mapped;
    }
}
