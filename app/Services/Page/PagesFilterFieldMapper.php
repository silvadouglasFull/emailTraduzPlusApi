<?php

namespace App\Services\Page;

use App\Services\FilterFieldMapperInterface;

class PagesFilterFieldMapper implements FilterFieldMapperInterface
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
