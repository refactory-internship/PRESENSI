<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\OfficeService;
use App\Models\Division;
use App\Models\Office;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;

class OfficeController extends Controller
{
    private $index = 'web.admin.offices.index';
    private $officeService;

    public function __construct(OfficeService $officeService)
    {
        $this->officeService = $officeService;
    }

    public function index()
    {
        $offices = Office::query()->paginate(5);
        return view('admin.office.index', compact('offices'));
    }

    public function create()
    {
        $provinces = Province::query()->pluck('name', 'id');
        $divisions = Division::all();
        return view('admin.office.create', compact('provinces', 'divisions'));
    }

    public function store(Request $request)
    {
        $this->officeService->store($request);
        return redirect()->route($this->index)->with('message', 'Office Added!');
    }

    public function show(Office $office)
    {
        return view('admin.office.show', compact('office'));
    }

    public function edit(Office $office)
    {
        $provinces = Province::query()->pluck('name', 'id');
        $divisions = Division::all();
        return view('admin.office.edit', compact('office', 'provinces', 'divisions'));
    }

    public function update(Request $request, Office $office)
    {
        $this->officeService->update($request, $office);
        return redirect()->route($this->index)->with('message', 'Office Updated!');
    }

    public function destroy(Office $office)
    {
        $office->delete();
        return redirect()->route($this->index)->with('danger', 'Office Deleted!');
    }
}
