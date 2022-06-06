<?php

namespace App\Http\Middleware;

use App\Enums\HttpStatus;
use Closure;
use Illuminate\Http\Request;

/**
 * Bearer token authentication middleware.
 */
class ApiAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        $token = request()->header('Authorization');

        // if no token is provided, return 401
        if (!$token) {
            return response()->json(null, HttpStatus::UNAUTHORIZED->value);
        }

        $token = str_replace('Bearer ', '', $token);

        // if token is invalid, return 403
        if ($token !== config('api.bearer')) {
            return response()->json(null, HttpStatus::FORBIDDEN->value);
        }

        return $next($request);
    }
}
