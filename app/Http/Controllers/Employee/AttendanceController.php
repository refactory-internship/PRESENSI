<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\AttendanceService;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index()
    {
        $user = auth()->id();
        $attendances = Attendance::query()->where('user_id', $user)->where('isOvertime', false)->get();
        return view('user.attendance.index', compact('attendances'));
    }

    public function create()
    {
        //variable to be used on the script section
        $currentDate = $this->attendanceService->getCurrentDate();
        $date = $this->attendanceService->getDateFromDatabase();
        return view('user.attendance.create', compact('date', 'currentDate'));
    }

    public function store(Request $request)
    {
        $this->attendanceService->store($request);
        return redirect()->route('web.employee.attendances.index')->with('message', 'Attendance Submitted!');
    }

    public function show($id)
    {
        $attendance = Attendance::query()->findOrFail($id);
        return view('user.attendance.show', compact('attendance'));
    }

    public function edit($id)
    {
        $attendance = Attendance::query()->findOrFail($id);
        return view('user.attendance.edit', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::query()->findOrFail($id);
        $attendance->update($request->all());
        return redirect()->route('web.employee.attendances.index')->with('message', 'Attendance Updated!');
    }

    public function destroy($id)
    {
        Attendance::query()->findOrFail($id)->delete();
        return redirect()->route('web.employee.attendances.index')->with('danger', 'Attendance Deleted!');
    }
}
