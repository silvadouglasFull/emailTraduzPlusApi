<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Middleware to validate API Key from request headers.
 */
class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('Api-Key');
        $validApiKey = config('apikey.key');
        if (!$apiKey || $apiKey !== $validApiKey) {
            return response()->json([
                'message' => 'Unauthorized. Invalid API Key.'
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
