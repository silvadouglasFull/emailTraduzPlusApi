<?php

namespace App\Filters;

class StringFilterStrategy implements FilterStrategyInterface
{
    public function process(mixed $value): mixed
    {
        return (string) $value;
    }
}
