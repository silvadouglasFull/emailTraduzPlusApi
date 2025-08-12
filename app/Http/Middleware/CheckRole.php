<?php

namespace App\Http\Middleware;

use App\Services\CheckRoleFactory;
use Closure;
use Illuminate\Http\Response;

class CheckRole
{
    public function handle($request, Closure $next, string $requiredRole)
    {
        $user = auth()->user();
        $strategy = CheckRoleFactory::make($requiredRole);
        if (!isset($user->role)) {
            return response()->json(["message" => "No role defined to user"], Response::HTTP_FORBIDDEN);
        } else if (!$strategy->check($user->role)) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}
