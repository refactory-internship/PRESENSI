<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\AttendanceService;
use App\Http\Services\DateTimeService;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AttendanceController extends Controller
{
    private $attendanceService;
    private $dateTimeService;

    public function __construct(AttendanceService $attendanceService, DateTimeService $dateTimeService)
    {
        $this->attendanceService = $attendanceService;
        $this->dateTimeService = $dateTimeService;
    }

    public function index()
    {
        $attendances = Cache::remember('attendance.all', 60, function () {
            return $this->attendanceService->getAttendance();
        });
        return view('user.attendance.index', compact('attendances'));
    }

    public function create()
    {
        //variable to be used on the script section
        $currentDate = $this->dateTimeService->getCurrentDate();
        $date = $this->dateTimeService->getDateFromDatabase();
        return view('user.attendance.create', compact('date', 'currentDate'));
    }

    public function store(Request $request)
    {
        $this->attendanceService->store($request);
        Cache::forget('attendance.all');
        return redirect()->route('web.employee.attendances.index')->with('message', 'Attendance Submitted!');
    }

    public function show($id)
    {
        $attendance = Attendance::query()->findOrFail($id);
        return view('user.attendance.show', compact('attendance'));
    }

    public function edit($id)
    {
        $currentDate = $this->dateTimeService->getCurrentDate();
        $attendance = Attendance::query()->findOrFail($id);
        return view('user.attendance.edit', compact('attendance', 'currentDate'));
    }

    public function update(Request $request, $id)
    {
        $this->attendanceService->update($request, $id);
        return redirect()->route('web.employee.attendances.index')->with('message', 'Attendance Updated!');
    }

    public function destroy($id)
    {
        Attendance::query()->findOrFail($id)->delete();
        return redirect()->route('web.employee.attendances.index')->with('danger', 'Attendance Deleted!');
    }
}
