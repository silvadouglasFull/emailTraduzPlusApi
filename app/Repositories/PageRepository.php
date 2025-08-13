<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    private int $user_id;
    public function __construct()
    {
        $this->user_id = auth()->user()->id;
    }
    public function all(): array
    {
        return Page::select(
            'pages.title',
            'pages.route',
            'pages.name as page_name',
            'pages.created_at',
            'pages.updated_at',
            'users.name',
        )
            ->join('users', 'users.id', '=', 'pages.user_id')
            ->where("user_id", $this->user_id)->get()->toArray();
    }

    public function find(int $id): ?Page
    {
        return Page::select(
            'pages.title',
            'pages.route',
            'pages.name as page_name',
            'pages.created_at',
            'pages.updated_at',
            'users.name',
        )
            ->join('users', 'users.id', '=', 'pages.user_id')
            ->where("user_id", $this->user_id)->first();
    }

    public function create(array $data): Page
    {
        $data["user_id"] = $this->user_id;
        return Page::create($data);
    }

    public function update(int $id, array $data): ?Page
    {
        $Page = Page::where("user_id", $this->user_id)->first($id);
        if (!$Page) {
            return null;
        }

        $Page->update($data);
        return $Page;
    }

    public function delete(int $id): bool
    {
        $Page = Page::where("user_id", $this->user_id)->first($id);
        return $Page ? $Page->delete() : false;
    }
}
