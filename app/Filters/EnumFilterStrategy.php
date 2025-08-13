<?php

namespace App\Filters;

use InvalidArgumentException;

class EnumFilterStrategy implements FilterStrategyInterface
{
    private array $allowed;

    public function __construct(array $allowed)
    {
        $this->allowed = $allowed;
    }

    public function process(mixed $value): mixed
    {
        if (!in_array($value, $this->allowed, true)) {
            throw new InvalidArgumentException("Invalid value: {$value}");
        }
        return $value;
    }
}
