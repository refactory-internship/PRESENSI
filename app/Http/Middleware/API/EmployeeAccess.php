<?php

namespace App\Http\Middleware\API;

use Closure;
use Illuminate\Http\Request;

class EmployeeAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->hasRole('Admin')) {
            return response()->json([
                'message' => 'Unauthorized, your role is Administrator!'
            ], 403);
        }
        return $next($request);
    }
}
