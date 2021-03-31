<?php

namespace App\Http\Controllers\API\Parent;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use App\Http\Services\AttendanceService;
use App\Models\Attendance;
use Illuminate\Http\Request;

class ApproveAttendanceController extends Controller
{
    private $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index()
    {
        $attendances = Attendance::query()
            ->where('approverId', auth()->id())
            ->latest()
            ->get();
        return response()->json(AttendanceResource::collection($attendances));
    }

    public function show($id)
    {
        return response()->json(new AttendanceResource(Attendance::query()->findOrFail($id)));
    }

    public function approve($id)
    {
        $this->attendanceService->approveAttendance($id);
        return response()->json([
            'data' => new AttendanceResource(Attendance::query()->findOrFail($id)),
            'message' => 'Attendance Approved'
        ]);
    }

    public function reject(Request $request, $id)
    {
        $this->attendanceService->rejectAttendance($request, $id);
        return response()->json([
            'data' => new AttendanceResource(Attendance::query()->findOrFail($id)),
            'message' => 'Attendance Rejected'
        ]);
    }
}
