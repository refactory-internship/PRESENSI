<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use App\Http\Services\AttendanceService;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index()
    {
        return response()->json($this->attendanceService->getAttendance());
    }

    public function store(Request $request)
    {
        return response()->json($this->attendanceService->store($request), 201);
    }

    public function show($id)
    {
        return response()->json(new AttendanceResource(Attendance::query()->findOrFail($id)));
    }

    public function update(Request $request, $id)
    {
        $this->attendanceService->update($request, $id);
        return response()->json([
            'data' => new AttendanceResource(Attendance::query()->findOrFail($id)),
            'message' => 'Attendance Updated'
        ]);
    }

    public function destroy($id)
    {
        Attendance::query()->findOrFail($id)->delete();
        // cache()->forget('attendance.all');
        return response()->json([
            'message' => 'Attendance Deleted'
        ]);
    }
}
