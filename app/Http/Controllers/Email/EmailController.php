<?php

namespace App\Http\Controllers\Email;

use App\Filters\DateFilterStrategy;
use App\Filters\FilterExtractor;
use App\Filters\IntegerFilterStrategy;
use App\Filters\StringFilterStrategy;
use App\Http\Requests\Email\EmailStoreRequest;
use App\Http\Requests\Email\EmailUpdateRequest;
use App\Services\Repository\Email\EmailService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class EmailController extends BaseController
{
    private EmailService $service;
    private array $strategies;

    public function __construct(EmailService $service)
    {
        $this->service = $service;
        $this->strategies = [
            'recipient_email' => new StringFilterStrategy(),
            'subject' => new StringFilterStrategy(),
            'body' => new StringFilterStrategy(),
            'status' => new IntegerFilterStrategy(),
            'sent_at' => new DateFilterStrategy(),
            'user_id' => new IntegerFilterStrategy(),
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
        $email = $this->service->getById((int)$id, $request->query('user_id'));
        return $email
            ? response()->json($email)
            : response()->json(['message' => 'Not found'], 404);
    }

    public function store(EmailStoreRequest $request)
    {
        try {
            $validatedData = $request->validate();
            $email = $this->service->create($validatedData ?? []);
            return response()->json($email, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['message' => 'Error creating email'], 500);
        }
    }

    public function update(EmailUpdateRequest $request, $id)
    {
        try {
            $email = $this->service->update((int)$id, $request->all());
            return $email
                ? response()->json($email)
                : response()->json(['message' => 'Not found'], 404);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy($id)
    {
        return $this->service->delete((int)$id)
            ? response()->json(['message' => 'Deleted successfully'])
            : response()->json(['message' => 'Not found'], 404);
    }
}
