<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FilterExtractor
{
    /**
     * @param Request $request
     * @param array<string, FilterStrategy> $fieldStrategies
     * @return array<string, mixed>
     */
    public static function extract(Request $request, array $fieldStrategies): array
    {
        $filters = [];
        foreach ($request->query() as $field => $value) {
            Log::info("$field = $value");
            if (isset($fieldStrategies[$field])) {
                $filters[$field] = $fieldStrategies[$field]->process($value);
            }
        }
        return $filters;
    }
}
