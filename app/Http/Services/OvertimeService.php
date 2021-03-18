<?php


namespace App\Http\Services;


use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OvertimeService
{
    public function update(Request $request, $id)
    {
        $attendance = Attendance::query()->find($id);
        $clockOutTime = Carbon::parse($attendance->clock_in_time)->addHours($request->overtime_duration)->toTimeString();
        $attendance->update([
            'task_plan' => $request->task_plan,
            'task_report' => $request->task_report,
            'overtimeDuration' => $request->overtime_duration,
            'clock_out_time' => $clockOutTime,
            'note' => $request->note
        ]);
        return $attendance;
    }
}
