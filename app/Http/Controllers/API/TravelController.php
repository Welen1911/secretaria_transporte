<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Resource\BaseController;
use App\Services\AutoMobileService;
use App\Services\DriverService;
use App\Services\RouteService;
use App\Services\TurnService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TravelController extends BaseController
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $route = RouteService::store([
                'driver_id' => $request->driver_id,
                'automobile_id' => $request->automobile_id,
                'status' => 1,
            ]);
    
            $routeTurn = $route->routeTurn()->create([
                'turn_id' => $request->turn_id,
            ]);

            DB::commit();
            return $this->sendResponse(['route' => $route, 'route_turn' => $routeTurn], "Rota Criada com Sucesso", 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao cadastrar a Rota", $th->getCode());
        }
    }
}
