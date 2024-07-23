<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

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
    public function store(Request $request)
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
    public function update(Request $request, string $id)
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
}
