<?php

namespace App\Http\Controllers;

use App\Filters\DateFilterStrategy;
use App\Filters\FilterExtractor;
use App\Filters\IntegerFilterStrategy;
use App\Filters\StringFilterStrategy;
use App\Services\Page\PageService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class PageController extends BaseController
{
    private PageService $service;
    private array $strategies;
    public function __construct(PageService $service)
    {
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

    public function show(Request $request)
    {
        $user_id = $request->query('user_id');
        $page = $this->service->getById((int)$user_id, null);
        return $page ? response()->json($page) : response()->json(['message' => 'Not found'], 404);
    }
    function store(array $data): bool
    {
        try {
            $this->service->create($data);
            return true;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $page = $this->service->update((int)$id, $data);
        return $page ? response()->json($page) : response()->json(['message' => 'Not found'], 404);
    }

    public function destroy($id)
    {
        return $this->service->delete((int)$id)
            ? response()->json(['message' => 'Deleted successfully'])
            : response()->json(['message' => 'Not found'], 404);
    }
}
