<?php

namespace App\Services\Repository\User;

use App\Repositories\User\UserRepositoryInterface;
use App\Services\Repository\AbstractService;
use App\Services\Repository\FilterFieldMapperInterface;
use App\Specifications\FormatBrazilianDateSpecification;

class UserService extends AbstractService
{

    public function __construct(
        private UserRepositoryInterface $repository,
        private FilterFieldMapperInterface $filterFieldMapper
    ) {
        $this->repository = $repository;
    }
    protected function repository(): UserRepositoryInterface
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
