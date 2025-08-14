<?php

namespace App\Http\Controllers;

use App\Services\CheckRole\RoleUserService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class RoleUserController extends BaseController
{
    private RoleUserService $service;
    public function __construct(RoleUserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show($id)
    {
        $roleUser = $this->service->getById((int)$id);
        return $roleUser ? response()->json($roleUser) : response()->json(['message' => 'Not found'], 404);
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
        $roleUser = $this->service->update((int)$id, $data);
        return $roleUser ? response()->json($roleUser) : response()->json(['message' => 'Not found'], 404);
    }

    public function destroy($id)
    {
        return $this->service->delete((int)$id)
            ? response()->json(['message' => 'Deleted successfully'])
            : response()->json(['message' => 'Not found'], 404);
    }
}
