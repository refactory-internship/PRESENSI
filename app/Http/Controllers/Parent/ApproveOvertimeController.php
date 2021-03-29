<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Http\Services\OvertimeService;
use App\Models\Overtime;
use Illuminate\Http\Request;

class ApproveOvertimeController extends Controller
{
    private $overtimeService;

    public function __construct(OvertimeService $overtimeService)
    {
        $this->overtimeService = $overtimeService;
    }


    public function index()
    {
        $overtimes = Overtime::query()
            ->where('approverId', auth()->id())
            ->latest()
            ->get();
        return view('user.parent.approve-overtime.index', compact('overtimes'));
    }

    public function show($id)
    {
        $overtime = Overtime::query()->find($id);
        return view('user.parent.approve-overtime.show', compact('overtime'));
    }

    public function approve($id)
    {
        $this->overtimeService->approveOvertime($id);
        return redirect()->back()->with('message', 'Overtime Approved!');
    }

    public function reject(Request $request, $id)
    {
        $this->overtimeService->rejectOvertime($request, $id);
        return redirect()->back()->with('danger', 'Attendance Rejected!');
    }
}
