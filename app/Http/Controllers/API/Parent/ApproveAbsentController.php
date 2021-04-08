<?php

namespace App\Http\Controllers\API\Parent;

use App\Http\Controllers\Controller;
use App\Http\Resources\AbsentResource;
use App\Http\Services\AbsentService;
use App\Models\Absent;
use Illuminate\Http\Request;

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
        return response()->json(AbsentResource::collection($absents));
    }

    public function show($id)
    {
        return response()->json(new AbsentResource(Absent::query()->findOrFail($id)));
    }

    public function approve($id)
    {
        $this->absentService->approveAbsent($id);
        return response()->json([
            'data' => new AbsentResource(Absent::query()->findOrFail($id)),
            'message' => 'Absent Approved'
        ]);
    }

    public function reject(Request $request, $id)
    {
        $this->absentService->rejectAbsent($request, $id);
        return response()->json([
            'data' => new AbsentResource(Absent::query()->findOrFail($id)),
            'message' => 'Absent Rejected'
        ]);
    }
}
