<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\DateTimeService;
use App\Http\Services\LeaveService;
use App\Models\Calendar;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    private $leaveService;
    private $dateTimeService;

    public function __construct(LeaveService $leaveService, DateTimeService $dateTimeService)
    {
        $this->leaveService = $leaveService;
        $this->dateTimeService = $dateTimeService;
    }

    public function index()
    {
        $leaves = $this->leaveService->getLeave();
        return view('user.leave.index', compact('leaves'));
    }

    public function store(Request $request)
    {
        $this->leaveService->store($request);
        return redirect()->route('web.employee.leaves.index')->with('message', 'Leave Submitted');
    }

    public function create()
    {
        $today = $this->dateTimeService->getCurrentDate()->toDateString();
        $last = Calendar::query()->orderBy('date', 'DESC')->first();
        $last = $last->date->format('Y-m-d');
        return view('user.leave.create', compact('today', 'last'));
    }

    public function show($id)
    {
        $leave = Leave::query()->findOrFail($id);
        return view('user.leave.show', compact('leave'));
    }

    public function edit($id)
    {
        $today = $this->dateTimeService->getCurrentDate()->toDateString();
        $last = Calendar::query()->orderBy('date', 'DESC')->first();
        $last = $last->date->format('Y-m-d');
        $leave = Leave::query()->findOrFail($id);
        return view('user.leave.edit', compact('leave', 'today', 'last'));
    }

    public function update(Request $request, $id)
    {
        $this->leaveService->update($request, $id);
        return redirect()->route('web.employee.leaves.index')->with('message', 'Leave Updated');
    }

    public function destroy($id)
    {
        Leave::query()->findOrFail($id)->delete();
        return redirect()->route('web.employee.leaves.index')->with('danger', 'Leave Deleted');
    }
}
