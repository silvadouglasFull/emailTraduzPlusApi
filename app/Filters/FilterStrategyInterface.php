<?php

namespace App\Filters;

interface FilterStrategyInterface
{
    /**
     * Process the raw query param value and return a value safe to use in the query.
     *
     * @param mixed $value
     * @return mixed
     */
    public function process(mixed $value): mixed;
}
