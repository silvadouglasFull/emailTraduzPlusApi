<?php

namespace App\Services\Repository\Page;

use App\Repositories\PageRepositoryInterface;
use App\Services\Repository\AbstractService;
use App\Services\Repository\FilterFieldMapperInterface;
use App\Specifications\FormatBrazilianDateSpecification;

class PageService extends AbstractService
{
    public function __construct(
        private PageRepositoryInterface $repository,
        private FilterFieldMapperInterface $filterFieldMapper
    ) {}

    protected function repository(): PageRepositoryInterface
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
