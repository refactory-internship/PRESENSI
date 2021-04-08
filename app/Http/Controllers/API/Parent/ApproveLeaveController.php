<?php

namespace App\Http\Controllers\API\Parent;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveResource;
use App\Http\Services\LeaveService;
use App\Models\Leave;
use Illuminate\Http\Request;

class ApproveLeaveController extends Controller
{
    private $leaveService;

    public function __construct(LeaveService $leaveService)
    {
        $this->leaveService = $leaveService;
    }

    public function index()
    {
        $leaves = Leave::query()
            ->where('approverId', auth()->id())
            ->latest()
            ->get();
        return response()->json(LeaveResource::collection($leaves));
    }

    public function show($id)
    {
        return response()->json(new LeaveResource(Leave::query()->findOrFail($id)));
    }

    public function approve($id)
    {
        $this->leaveService->approveLeave($id);
        return response()->json([
            'data' => new LeaveResource(Leave::query()->findOrFail($id)),
            'message' => 'Leave Approved'
        ]);
    }

    public function reject(Request $request, $id)
    {
        $this->leaveService->rejectLeave($request, $id);
        return response()->json([
            'data' => new LeaveResource(Leave::query()->findOrFail($id)),
            'message' => 'Leave Rejected'
        ]);
    }
}
