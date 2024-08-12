<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverRequest;
use App\Models\Driver;
use App\Services\DriverService;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::all();

        return response(['drivers' => $drivers], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DriverRequest $request)
    {
        $driver = Driver::create($request->all());

        return response(['driver' => $driver], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $driver = Driver::find($id);

        if (!$driver) {
            return response('', 404);
        }

        return response(['driver' => $driver], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DriverRequest $request, string $id)
    {
        $driver = Driver::find($id);

        if (!$driver) {
            return response('', 404);
        }

        $driver->update($request->all());

        return response(['driver' => $driver], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $driver = Driver::find($id);

        if (!$driver) {
            return response('', 404);
        }

        $driver->delete();

        return response(['driver' => $driver], 200);
    }

    public function getByTurnAndCategoryCNH(string $turnId, string $capacity) {
        $drivers = DriverService::getByTurnAndCategoryCNH($capacity, $turnId);

        return response(['drivers' => $drivers], 200);
    }
}
