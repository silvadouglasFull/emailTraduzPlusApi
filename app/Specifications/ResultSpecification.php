<?php

namespace App\Specifications;

use Illuminate\Support\Collection;

/**
 * ResultSpecification
 *
 * Abstraction for result post-processing (formatting, mapping, masking, etc).
 */
interface ResultSpecification
{
    /**
     * Apply the transformation over an Eloquent result.
     *
     * @param array<int, array<string, mixed>>|Collection<int, array<string, mixed>> $items
     * @return array<int, array<string, mixed>>
     */
    public function apply(array|Collection $items): array;
}
