<?php

namespace App\Services;

interface FilterFieldMapperInterface
{
    public function map(array $filters): array;
}
