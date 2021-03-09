<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Office;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::all();
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
        $office = Office::query()->create([
            'village_id' => $request->villages,
            'name' => $request->name,
            'address' => $request->address
        ]);
        $office->division()->attach($request->divisions);

        return redirect()->route('web.offices.index')->with('message', 'Office Added!');
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
        $office->update([
            'village_id' => $request->villages,
            'name' => $request->name,
            'address' => $request->address
        ]);
        $office->division()->sync($request->divisions);

        return redirect()->route('web.offices.index')->with('message', 'Office Updated!');
    }

    public function destroy(Office $office)
    {
        $office->delete();
        return redirect()->route('web.offices.index')->with('danger', 'Office Deleted!');
    }
}
