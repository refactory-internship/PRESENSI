<?php

namespace App\Http\Middleware\API;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ApproveAttendance
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
        if (!Gate::allows('approve-attendances')) {
            return response()->json([
                'message' => 'You are not authorized to approve any attendance!'
            ], 403);
        }
        return $next($request);
    }
}
