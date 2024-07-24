<?php

namespace App\Http\Controllers;

use App\Services\AutoMobileService;
use App\Services\DriverService;
use App\Services\RouteService;
use App\Services\TurnService;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function store(Request $request)
    {

        $autoMobile = AutoMobileService::getByCapacity($request->numberPassengers);

        $driver = DriverService::getByCategoryCNH($request->numberPassengers);

        $turn = TurnService::show($request->turn_id);

        if (!$request->passengers) {
            $route = RouteService::store([
                'driver_id' => $driver->id,
                'automobile_id' => $autoMobile->id,
                'status' => 1,
            ]);

            $routeTurn = $route->routeTurn()->create([
                'turn_id' => $turn->id,
            ]);

            return response([
                'automobile' => $autoMobile,
                'driver' => $driver,
                'turn' => $turn,
                'route' => $route,
                'route_turn' => $routeTurn,
            ], 200);
        }

        return response([
            'automobile' => $autoMobile,
            'driver' => $driver,
            'turn' => $turn
        ], 200);
    }
}
