<?php

namespace App\Services\Repository\User;

use App\Services\Repository\FilterFieldMapperInterface;

class UserFilterFieldMapper implements FilterFieldMapperInterface
{
    public function map(array $filters): array
    {
        $mapped = [];

        foreach ($filters as $field => $value) {
            $mapped["users.$field"] = $value;
        }
        return $mapped;
    }
}
