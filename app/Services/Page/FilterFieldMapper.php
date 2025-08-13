<?php

namespace App\Services\Page;

use App\Services\FilterFieldMapperInterface;

class FilterFieldMapper implements FilterFieldMapperInterface
{
    public function map(array $filters): array
    {
        $mapped = [];

        foreach ($filters as $field => $value) {
            $mapped[$field === 'name' ? "users.$field" : "pages.$field"] = $value;
        }

        return $mapped;
    }
}
