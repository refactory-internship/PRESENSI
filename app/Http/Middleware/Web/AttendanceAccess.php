<?php

namespace App\Http\Middleware\Web;

use App\Models\Attendance;
use App\Models\Overtime;
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
        $overtime = Overtime::query()->find($request->route('overtime'));

        if ($attendance && $attendance->user->id !== auth()->id() ||
            $overtime && $overtime->user->id !== auth()->id()) {
            abort(403);
        }

        return $next($request);
    }
}
