<?php

namespace App\Repositories;

use App\Specifications\ResultSpecification;

/**
 * BaseRepository
 *
 * Provides a reusable hook to apply post-query result specifications.
 */
abstract class BaseRepository
{
    /**
     * @param array<int, array<string, mixed>> $rows
     * @param array<int, ResultSpecification>  $specs
     * @return array<int, array<string, mixed>>
     */
    protected function applyResultSpecs(array $rows, array $specs): array
    {
        foreach ($specs as $spec) {
            $rows = $spec->apply($rows);
        }
        return $rows;
    }
}
