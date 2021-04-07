<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    private $index = 'web.admin.divisions.index';

    public function index()
    {
        $divisions = Division::all();
        return view('admin.division.index', compact('divisions'));
    }

    public function create()
    {
        return view('admin.division.create');
    }

    public function store(Request $request)
    {
        Division::query()->create($request->all());
        return redirect()->route($this->index)->with('message', 'Division Added!');
    }

    public function show(Division $division)
    {
        return view('admin.division.show', compact('division'));
    }

    public function edit(Division $division)
    {
        return view('admin.division.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $division->update($request->all());
        return redirect()->route($this->index)->with('message', 'Division Updated!');
    }

    public function destroy(Division $division)
    {
        $division->delete();
        return redirect()->route($this->index)->with('danger', 'Division Deleted!');
    }
}
