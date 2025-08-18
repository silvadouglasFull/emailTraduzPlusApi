<?php

namespace App\Services\Repository\RoleUser;

use App\Repositories\RoleUser\RoleUserRepositoryInterface;
use App\Services\Repository\AbstractService;
use App\Services\Repository\FilterFieldMapperInterface;
use App\Specifications\FormatBrazilianDateSpecification;

class RoleUserService extends AbstractService
{

    public function __construct(
        private RoleUserRepositoryInterface $repository,
        private FilterFieldMapperInterface $filterFieldMapper
    ) {
        $this->repository = $repository;
    }
    protected function repository(): RoleUserRepositoryInterface
    {
        return $this->repository;
    }

    protected function mapFilters(array $filters): array
    {
        return $this->filterFieldMapper->map($filters);
    }

    protected function resultSpecifications(): array
    {
        return [
            new FormatBrazilianDateSpecification(['created_at', 'updated_at']),
        ];
    }
}
