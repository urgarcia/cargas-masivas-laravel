<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Passport\Http\Middleware\EnsureFrontendRequestsAreStateful;

class VerifyPassportToken extends EnsureFrontendRequestsAreStateful
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('Authorization')) {
            throw new \Illuminate\Auth\Access\AuthorizationException('Unauthorized');
        }
        
        $exploded = explode(' ', $request->header('Authorization'));

        if (!isset($exploded[0]) || !isset($exploded[1]) || $exploded[0] !== 'Bearer') {
            throw new \Illuminate\Auth\Access\AuthorizationException('Unauthorized');
        }

        try {
            $user = auth()->guard('api')->user();
        } catch (\Throwable $e) {
            throw new \Illuminate\Auth\Access\AuthorizationException('Unauthorized');
        }

        return $next($request);
    }
}
