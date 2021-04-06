<?php

namespace App\Http\Controllers\API\Parent;

use App\Http\Controllers\Controller;
use App\Http\Resources\OvertimeResource;
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
            ->where('isFinished', true)
            ->latest()
            ->get();
        return response()->json(OvertimeResource::collection($overtimes));
    }

    public function show($id)
    {
        return response()->json(new OvertimeResource(Overtime::query()->findOrFail($id)));
    }

    public function approve($id)
    {
        $this->overtimeService->approveOvertime($id);
        return response()->json([
           'data' => new OvertimeResource(Overtime::query()->findOrFail($id)),
           'message' => 'Overtime Approved'
        ]);
    }

    public function reject(Request $request, $id)
    {
        $this->overtimeService->rejectOvertime($request, $id);
        return response()->json([
           'data' => new OvertimeResource(Overtime::query()->findOrFail($id)),
           'message' => 'Overtime Rejected'
        ]);
    }
}
