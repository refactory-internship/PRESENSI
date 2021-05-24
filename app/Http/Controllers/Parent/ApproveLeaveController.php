<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Http\Services\LeaveService;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApproveLeaveController extends Controller
{
    private $leaveService;

    public function __construct(LeaveService $leaveService)
    {
        $this->leaveService = $leaveService;
    }

    public function index()
    {
        $leaves = Cache::remember('approve_leave.all', 60, function () {
            return Leave::query()
                ->where('approverId', auth()->id())
                ->latest()
                ->get();
        });
        return view('user.parent.approve-leave.index', compact('leaves'));
    }

    public function show($id)
    {
        $leave = Leave::query()->findOrFail($id);
        return view('user.parent.approve-leave.show', compact('leave'));
    }

    public function approve($id)
    {
        $this->leaveService->approveLeave($id);
        return redirect()->route('web.employee.approve-leaves.index')->with('message', 'Leave Approved');
    }

    public function reject(Request $request, $id)
    {
        $this->leaveService->rejectLeave($request, $id);
        return redirect()->route('web.employee.approve-leaves.index')->with('danger', 'Leave Rejected');
    }
}
