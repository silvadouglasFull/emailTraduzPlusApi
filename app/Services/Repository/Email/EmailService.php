<?php

namespace App\Services\Repository\Email;

use App\Repositories\Email\EmailRepositoryInterface;
use App\Services\Repository\AbstractService;
use App\Services\Repository\FilterFieldMapperInterface;
use App\Specifications\FormatBrazilianDateSpecification;

class EmailService extends AbstractService
{
    public function __construct(
        private EmailRepositoryInterface $repository,
        private FilterFieldMapperInterface $filterFieldMapper
    ) {}

    protected function repository(): EmailRepositoryInterface
    {
        return $this->repository;
    }

    protected function mapFilters(array $filters): array
    {
        // Aqui usamos explicitamente a interface
        return $this->filterFieldMapper->map($filters);
    }

    protected function resultSpecifications(): array
    {
        return [
            new FormatBrazilianDateSpecification(['created_at', 'updated_at']),
        ];
    }
}
