<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class AuthenticateSessionToken
{
    public function handle($request, Closure $next)
    {
        $sessionToken = $request->header('session_token');

        if (!$sessionToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = User::where('session_token', $sessionToken)->first();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // You can optionally bind the authenticated user instance to the request
        $request->merge(['user' => $user]);

        return $next($request);
    }
}
