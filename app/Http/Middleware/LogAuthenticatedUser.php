<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LogAuthenticatedUser
{
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            \Log::info('Authenticated User: ', ['id' => $user->id, 'email' => $user->email]);
        } else {
            \Log::info('No authenticated user found.');
        }
        $request->user = $user;
        return $next($request);
    }
}
