<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\OvertimeResource;
use App\Http\Services\OvertimeService;
use App\Models\Overtime;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    private $overtimeService;

    public function __construct(OvertimeService $overtimeService)
    {
        $this->overtimeService = $overtimeService;
    }

    public function index()
    {
        return response()->json($this->overtimeService->getOvertime());
    }

    public function store(Request $request)
    {
        return response()->json($this->overtimeService->store($request), 201);
    }

    public function show($id)
    {
        return response()->json(new OvertimeResource(Overtime::query()->findOrFail($id)));
    }

    public function update(Request $request, $id)
    {
        $this->overtimeService->update($request, $id);
        return response()->json([
            'data' => new AttendanceResource(Overtime::query()->findOrFail($id)),
            'message' => 'Overtime Updated'
        ]);
    }

    public function destroy($id)
    {
        Overtime::query()->findOrFail($id)->delete();
        return response()->json([
            'message' => 'Overtime Deleted'
        ]);
    }
}
