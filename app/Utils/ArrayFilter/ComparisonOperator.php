<?php

namespace App\Utils\ArrayFilter;

/**
 * Comparison operators for array filtering.
 */
enum ComparisonOperator: string
{
    case GREATER_THAN = 'greater_than';
    case LESS_OR_EQUAL = 'less_or_equal';
    case EQUAL = 'equal';
}
