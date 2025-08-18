<?php

namespace App\Http\Controllers\RoleUser;

use App\Filters\DateFilterStrategy;
use App\Filters\FilterExtractor;
use App\Filters\IntegerFilterStrategy;
use App\Filters\StringFilterStrategy;
use App\Http\Requests\RoleUser\RoleUserStoreRequest;
use App\Http\Requests\RoleUser\RoleUserUpdateRequest;
use App\Services\Repository\RoleUser\RoleUserService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RoleUserController extends BaseController
{
    private RoleUserService $service;
    private array $strategies;

    public function __construct(RoleUserService $service)
    {
        $this->service = $service;
        $this->strategies = [
            'role_users.role' => new StringFilterStrategy(),
            'role_users.users_id' => new IntegerFilterStrategy(),
            'users.name' => new StringFilterStrategy(),
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
        $roleUser = $this->service->getById((int)$id, $request->query('user_id'));
        return $roleUser
            ? response()->json($roleUser)
            : response()->json(['message' => 'Not found'], 404);
    }

    public function store(RoleUserStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $roleUser = $this->service->create($validatedData);
            return response()->json($roleUser, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['message' => 'Error creating roleUser'], 500);
        }
    }

    public function update(RoleUserUpdateRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $roleUser = $this->service->update((int)$id, $validatedData);
            return $roleUser
                ? response()->json($roleUser)
                : response()->json(['message' => 'Not found'], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['message' => 'Error creating roleUser'], 500);
        }
    }

    public function destroy($id)
    {
        return $this->service->delete((int)$id)
            ? response()->json(['message' => 'Deleted successfully'])
            : response()->json(['message' => 'Not found'], 404);
    }
}
