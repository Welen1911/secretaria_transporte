<?php

namespace App\Http\Controllers;

use App\Http\Requests\TurnRequest;
use App\Models\Turn;

class TurnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $turns = Turn::all();

        return response(['turns' => $turns], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TurnRequest $request)
    {
        $turn = Turn::create($request->all());

        return response(['turn' => $turn], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $turn = Turn::find($id);

        if (!$turn) {
            return response('', 404);
        }

        return response(['turn' => $turn], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TurnRequest $request, string $id)
    {
        $turn = Turn::find($id);

        if (!$turn) {
            return response('', 404);
        }

        $turn->update($request->all());

        return response(['turn' => $turn], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $turn = Turn::find($id);

        if (!$turn) {
            return response('', 404);
        }

        $turn->delete();

        return response(['turn' => $turn], 200);
    }
}
