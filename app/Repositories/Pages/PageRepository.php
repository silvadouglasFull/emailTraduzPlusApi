<?php

namespace App\Repositories\Pages;

use App\Models\Page;
use App\Repositories\BaseRepository;
use App\Utils\Dates\DateValidator;
use App\Utils\PaginationHelper;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{

    /**
     * @param array<string, mixed> $filters Optional simple filters
     * @param array<int, ResultSpecification>  $resultSpecs Result transformers (e.g., date formatting)
     * @return array<int, array<string, mixed>>
     */
    public function all(array $filters = [], array $resultSpecs = []): array
    {
        $query = Page::select(
            'pages.title',
            'pages.route',
            'pages.name as page_name',
            'pages.created_at',
            'pages.updated_at',
            'users.name',
        )
            ->join('users', 'users.id', '=', 'pages.user_id');
        foreach ($filters as $field => $value) {
            // Whitelist to avoid invalid columns / injection
            if (in_array($field, [
                'pages.title',
                'pages.route',
                'pages.user_id',
                'page_name',
                'pages.created_at',
                'pages.updated_at',
                'users.name'
            ], true)) {
                $query->when(is_string($value) && (!DateValidator::isValidDate($value)), function ($query) use ($field, $value) {
                    return $query->where($field, "LIKE", "%$value%");
                })
                    ->when(is_numeric($value), function ($query) use ($field, $value) {
                        return $query->where($field, $value);
                    });
            }
        }
        $result = $query->paginate()->toArray();
        return array_merge(
            ["data" => $this->applyResultSpecs($result["data"], $resultSpecs)],
            PaginationHelper::extract($result)
        );
    }

    public function find(int $id, ?int $user_id): ?Page
    {
        return Page::select(
            'pages.title',
            'pages.route',
            'pages.name as page_name',
            'pages.created_at',
            'pages.updated_at',
            'users.name',
        )
            ->join(
                'users',
                'users.id',
                '=',
                'pages.user_id'
            )
            ->when(is_numeric($user_id), function ($query) use ($user_id) {
                return $query->where(
                    'pages.user_id',
                    '=',
                    $user_id
                );
            })
            ->first();
    }

    public function create(array $data): Page
    {
        return Page::create($data);
    }

    public function update(int $id, array $data): ?Page
    {
        $Page = Page::find($id);
        if (!$Page) {
            return null;
        }

        $Page->update($data);
        return $Page;
    }

    public function delete(int $id): bool
    {
        $Page = Page::find($id);
        return $Page ? $Page->delete() : false;
    }
}
