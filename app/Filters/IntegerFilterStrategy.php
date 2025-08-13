<?php

namespace App\Filters;

class IntegerFilterStrategy implements FilterStrategyInterface
{
    public function process(mixed $value): mixed
    {
        return (int) $value;
    }
}
