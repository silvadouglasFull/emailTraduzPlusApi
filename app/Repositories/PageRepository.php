<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    public function all(): array
    {
        return Page::all()->toArray();
    }

    public function find(int $id): ?Page
    {
        return Page::find($id);
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
