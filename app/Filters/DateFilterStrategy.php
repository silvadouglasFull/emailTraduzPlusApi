<?php

namespace App\Filters;

use Carbon\Carbon;
use InvalidArgumentException;

class DateFilterStrategy implements FilterStrategyInterface
{
    private string $format;

    public function __construct(string $format = 'd/m/Y')
    {
        $this->format = $format;
    }

    public function process(mixed $value): mixed
    {
        try {
            return Carbon::createFromFormat($this->format, $value)->toDateString();
        } catch (\Exception $e) {
            throw new InvalidArgumentException("Invalid date format: {$value}");
        }
    }
}
