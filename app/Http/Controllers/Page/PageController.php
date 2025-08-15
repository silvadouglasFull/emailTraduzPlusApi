<?php

namespace App\Http\Controllers\Page;

use App\Filters\DateFilterStrategy;
use App\Filters\FilterExtractor;
use App\Filters\IntegerFilterStrategy;
use App\Filters\StringFilterStrategy;
use App\Http\Requests\Page\PageStoreRequest;
use App\Http\Requests\Page\PageUpdateRequest;
use App\Services\Repository\Page\PageService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class PageController extends BaseController
{
    private PageService $service;
    private array $strategies;

    public function __construct(
        PageService $service
    ) {
        $this->service = $service;
        $this->strategies = [
            'user_id' => new IntegerFilterStrategy(),
            'title' => new StringFilterStrategy(),
            'route' => new StringFilterStrategy(),
            'name' => new StringFilterStrategy(),
            'created_at' => new DateFilterStrategy(),
        ];
    }

    public function index(Request $request)
    {
        $filters = FilterExtractor::extract($request, $this->strategies);
        return response()->json($this->service->getAll($filters));
    }

    public function show(Request $request, $id)
    {
        $page = $this->service->getById((int)$id, $request->query('user_id'));
        return $page
            ? response()->json($page)
            : response()->json(['message' => 'Not found'], 404);
    }

    public function store(PageStoreRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $this->service->create($validated);
            return response()->json($page, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['message' => 'Error creating page'], 500);
        }
    }

    public function update($id, PageUpdateRequest $request)
    {
        $validated = $request->validated();
        $page = $this->service->update((int)$id, $validated);
        return $page
            ? response()->json($page)
            : response()->json(['message' => 'Not found'], 404);
    }

    public function destroy($id)
    {
        return $this->service->delete((int)$id)
            ? response()->json(['message' => 'Deleted successfully'])
            : response()->json(['message' => 'Not found'], 404);
    }
}
