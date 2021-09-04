<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Http\Services\AbsentService;
use App\Models\Absent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApproveAbsentController extends Controller
{
    private $absentService;

    public function __construct(AbsentService $absentService)
    {
        $this->absentService = $absentService;
    }

    public function index()
    {
        $absents = Absent::query()
            ->where('approverId', auth()->id())
            ->latest()
            ->get();
        return view('user.parent.approve-absent.index', compact('absents'));
    }

    public function show($id)
    {
        $absent = Absent::query()->findOrFail($id);
        return view('user.parent.approve-absent.show', compact('absent'));
    }

    public function approve($id)
    {
        $this->absentService->approveAbsent($id);
        return redirect()->route('web.employee.approve-absents.index')->with('message', 'Absent Approved');
    }

    public function reject(Request $request, $id)
    {
        $this->absentService->rejectAbsent($request, $id);
        return redirect()->route('web.employee.approve-absents.index')->with('danger', 'Absent Rejected');
    }
}
