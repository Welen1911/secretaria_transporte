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
        $route = RouteService::store([
            'driver_id' => $request->driver_id,
            'automobile_id' => $request->automobile_id,
            'status' => 1,
        ]);

        $routeTurn = $route->routeTurn()->create([
            'turn_id' => $request->turn_id,
        ]);

        return response([
            'route' => $route,
            'route_turn' => $routeTurn,
        ], 200);
    }
}
