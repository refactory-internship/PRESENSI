<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\AbsentResource;
use App\Http\Services\AbsentService;
use App\Models\Absent;
use Illuminate\Http\Request;

class AbsentController extends Controller
{
    private $absentService;

    public function __construct(AbsentService $absentService)
    {
        $this->absentService = $absentService;
    }

    public function index()
    {
        return response()->json($this->absentService->getAbsent());
    }

    public function store(Request $request)
    {
        return response()->json($this->absentService->store($request), 201);
    }

    public function show($id)
    {
        return response()->json(new AbsentResource(Absent::query()->findOrFail($id)));
    }

    public function update(Request $request, $id)
    {
        $this->absentService->update($request, $id);
        return response()->json([
           'data' => new AbsentResource(Absent::query()->findOrFail($id)),
           'message' => 'Absent Updated'
        ]);
    }

    public function destroy($id)
    {
        Absent::query()->findOrFail($id)->delete();
        return response()->json([
            'message' => 'Absent Deleted'
        ]);
    }
}
