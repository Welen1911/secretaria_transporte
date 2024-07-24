<?php

namespace App\Http\Controllers;

use App\Services\AutoMobileService;
use App\Services\DriverService;
use App\Services\TurnService;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function store(Request $request)
    {

        $autoMobile = AutoMobileService::getByCapacity($request->numberPassengers);

        $driver = DriverService::getByCategoryCNH($request->numberPassengers);

        $turn = TurnService::show($request->turn_id);

        return response([
            'automobile' => $autoMobile,
            'driver' => $driver,
            'turn' => $turn
        ], 200);
    }
}
