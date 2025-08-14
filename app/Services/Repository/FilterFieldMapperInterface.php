<?php

namespace App\Services\Repository;

interface FilterFieldMapperInterface
{
    public function map(array $filters): array;
}
