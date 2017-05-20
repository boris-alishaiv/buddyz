<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = JWTAuth::parseToken()->toUser();

        if ($user->type != 'admin') {
            return response()->json(['error' => 'Permission denied'], 400);
        }

        return $next($request);
    }
}
