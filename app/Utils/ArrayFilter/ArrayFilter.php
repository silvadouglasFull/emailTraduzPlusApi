<?php

namespace App\Utils\ArrayFilter;

use InvalidArgumentException;

/**
 * Class responsible for filtering arrays using a given comparison operator.
 */
class ArrayFilter implements ArrayFilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function filter(array $array, string $field, mixed $value, string $operator): array
    {
        return array_values(array_filter($array, function ($item) use ($field, $value, $operator) {
            return $this->applyOperator($item[$field] ?? null, $value, $operator);
        }));
    }

    /**
     * Applies the comparison operator to two values.
     *
     * @param mixed  $fieldValue The actual value in the array.
     * @param mixed  $target     The value to compare with.
     * @param string $operator   Operator used for comparison.
     *
     * @return bool True if condition is met.
     */
    private function applyOperator(mixed $fieldValue, mixed $target, string $operator): bool
    {
        return match ($operator) {
            ComparisonOperator::GREATER_THAN->value => $fieldValue > $target,
            ComparisonOperator::LESS_OR_EQUAL->value => $fieldValue <= $target,
            ComparisonOperator::EQUAL->value => $fieldValue === $target,
            default => throw new InvalidArgumentException("Invalid operator: $operator"),
        };
    }
}
