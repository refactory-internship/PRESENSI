<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\LeaveService;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LeaveController extends Controller
{
    private $leaveService;

    public function __construct(LeaveService $leaveService)
    {
        $this->leaveService = $leaveService;
    }

    public function index()
    {
        $user = auth()->id();
        $leaves = Cache::remember('leave.all', 60, function () use ($user) {
            return Leave::query()
                ->where('user_id', $user)
                ->latest()
                ->get();
        });
        return view('user.leave.index', compact('leaves'));
    }

    public function store(Request $request)
    {
        $this->leaveService->store($request);
        return redirect()->route('web.employee.leaves.index')->with('message', 'Leave Submitted');
    }

    public function create()
    {
        return view('user.leave.create');
    }

    public function show($id)
    {
        $leave = Leave::query()->findOrFail($id);
        return view('user.leave.show', compact('leave'));
    }

    public function edit($id)
    {
        $leave = Leave::query()->findOrFail($id);
        return view('user.leave.edit', compact('leave'));
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
