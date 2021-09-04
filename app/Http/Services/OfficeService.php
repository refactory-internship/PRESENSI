<?php


namespace App\Http\Services;


use App\Models\Office;
use Illuminate\Http\Request;

class OfficeService
{
    public function store(Request $request)
    {
        $office = Office::query()->create([
            'village_id' => $request->villages,
            'name' => $request->name,
            'address' => $request->address
        ]);
        cache()->forget('office.all');
        return $office->division()->attach($request->divisions);
    }

    public function update(Request $request, Office $office)
    {
        $office->update([
            'village_id' => $request->villages,
            'name' => $request->name,
            'address' => $request->address
        ]);
        cache()->forget('office.all');
        return $office->division()->sync($request->divisions);
    }
}
