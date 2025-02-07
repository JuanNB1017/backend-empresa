<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Please register and login or only login to continue',
                'status' => false,
                'code' => 403
            ], 403);
        }

        return route('login');
    }
}
