<?php

namespace App\Http\Middleware\Web;

use App\Models\Attendance;
use Closure;
use Illuminate\Http\Request;

class AttendanceAccess
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
        $attendance = Attendance::query()->find($request->route('attendance'));
        $overtime = Attendance::query()->find($request->route('overtime'));
        if ($attendance && $attendance->user_id != auth()->id() || $overtime && $overtime->user_id != auth()->id()) {
            abort(403);
        }
        return $next($request);
    }
}
