<?php

namespace App\Services\Repository\Page;

use App\Services\Repository\FilterFieldMapperInterface;

class PageFilterFieldMapper implements FilterFieldMapperInterface
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
