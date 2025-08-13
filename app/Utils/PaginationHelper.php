<?php

namespace App\Utils;

class PaginationHelper
{
    public static function extract(array $paginator): array
    {
        return [
            "next_page_url" => $paginator["next_page_url"],
            "path" => $paginator["path"],
            "per_page" => $paginator["per_page"],
            "prev_page_url" => $paginator["prev_page_url"],
            "to" => $paginator["to"],
            "total" => $paginator["total"],
            "first_page_url" => $paginator["first_page_url"],
            "from" => $paginator["from"],
            "last_page" => $paginator["last_page"],
            "last_page_url" => $paginator["last_page_url"],
            "links" => $paginator["links"],
            "current_page" => $paginator["current_page"],
        ];
    }
}
