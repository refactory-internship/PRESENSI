<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveResource;
use App\Http\Services\LeaveService;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    private $leaveService;

    public function __construct(LeaveService $leaveService)
    {
        $this->leaveService = $leaveService;
    }

    public function index()
    {
        return response()->json($this->leaveService->getLeave());
    }

    public function store(Request $request)
    {
        return response()->json($this->leaveService->store($request), 201);
    }

    public function show($id)
    {
        return response()->json(new LeaveResource(Leave::query()->findOrFail($id)));
    }

    public function update(Request $request, $id)
    {
        $this->leaveService->update($request, $id);
        return response()->json([
            'data' => new LeaveResource(Leave::query()->findOrFail($id)),
            'message' => 'Leave Updated'
        ]);
    }

    public function destroy($id)
    {
        Leave::query()->findOrFail($id)->delete();
        return response()->json([
            'message' => 'Leave Deleted'
        ]);
    }
}
