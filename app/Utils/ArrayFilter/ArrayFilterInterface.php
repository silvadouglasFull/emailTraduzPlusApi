<?php

namespace App\Utils\ArrayFilter;

/**
 * Interface for filtering an array by a field, value, and operator.
 */
interface ArrayFilterInterface
{
    /**
     * Filters an array of associative arrays based on a specific field and operator.
     *
     * @param array  $array    Array of associative arrays.
     * @param string $field    Field to filter by.
     * @param mixed  $value    Value to compare against.
     * @param string $operator Operator for comparison.
     *
     * @return array Filtered array.
     */
    public function filter(array $array, string $field, mixed $value, string $operator): array;
}
