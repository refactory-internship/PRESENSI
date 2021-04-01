<?php

namespace App\Http\Middleware\Web;

use App\Models\Attendance;
use App\Models\Overtime;
use Closure;
use Illuminate\Http\Request;

class ParentAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $attendance = Attendance::query()->find($request->route('approve_attendance'));
        $overtime = Overtime::query()->find($request->route('approve_overtime'));

        if ($attendance && $attendance->approverId !== auth()->id() ||
            $overtime && $overtime->approverId !== auth()->id()) {
            abort(403);
        }

        return $next($request);
    }
}