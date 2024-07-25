<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutoMobileRequest;
use App\Models\AutoMobile;
use App\Services\AutoMobileService;

class AutoMobileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $autoMobiles = AutoMobile::all();

        return response(['auto_mobiles' => $autoMobiles], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AutoMobileRequest $request)
    {
        $autoMobile = AutoMobile::create($request->all());

        return response(['automobile' => $autoMobile], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $autoMobile = AutoMobile::find($id);

        if (!$autoMobile) {
            return response('', 404);
        }

        return response(['automobile' => $autoMobile], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AutoMobileRequest $request, string $id)
    {
        $autoMobile = AutoMobile::find($id);

        if (!$autoMobile) {
            return response('', 404);
        }

        $autoMobile->update($request->all());

        return response(['automobile' => $autoMobile], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $autoMobile = AutoMobile::find($id);

        if (!$autoMobile) {
            return response('', 404);
        }

        $autoMobile->delete();

        return response(['automobile' => $autoMobile], 200);
    }

    public function getByTurnAndCapacitiy(string $turnId, string $capacity)
    {
        $autoMobiles = AutoMobileService::getByTurnCapacity($capacity, $turnId);

        return response(['autoMobiles' => $autoMobiles], 200);
    }
}
