<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class AdminOrUser
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
        $requestedUserId = $request->route()->parameters()['userId'];
        $user = JWTAuth::parseToken()->toUser();

        if ($user->type == 'admin') {
            return $next($request);
        }

        if ($requestedUserId != $user->id){
            return response()->json(['error' => 'Permission denied'], 400);
        }

        return $next($request);
    }
}
