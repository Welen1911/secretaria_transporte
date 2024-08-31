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
    public function index()
    {
        try {
            // $routes = RouteService::index();

            $routes = DB::table('v_routes')->get();

            return $this->sendResponse(['routes' => $routes]);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), "Falha ao pegar rotas", $th->getCode());
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $route = RouteService::store([
                'driver_id' => $request->driver_id,
                'automobile_id' => $request->automobile_id,
                'status' => 1,
                'turn_id' => $request->turn_id,
                'capacity' => $request->passengersNumber
            ]);

            // $routeTurn = $route->routeTurn()->create([
            //     'turn_id' => $request->turn_id,
            // ]);

            DB::commit();
            // return $this->sendResponse(['route' => $route, 'route_turn' => $routeTurn], "Rota Criada com Sucesso", 201);
            return $this->sendResponse(['route' => $route], "Rota Criada com Sucesso", 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao cadastrar a Rota", $th->getCode());
        }
    }

    public function show(string $id)
    {
        try {
            $route = RouteService::show($id);

            return $this->sendResponse(['route' => $route]);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), "Falha ao pegar a Rota", $th->getCode());
        }
    }

    public function update(string $id, Request $request)
    {
        try {
            $route = RouteService::update($id, [
                'driver_id' => $request->driver_id,
                'automobile_id' => $request->automobile_id,
                'status' => 1,
                'turn_id' => $request->turn_id,
                'capacity' => $request->passengersNumber
            ]);

            return $this->sendResponse(['route' => $route]);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), "Falha ao excluir a Rota", $th->getCode());
        }
    }


    public function destroy(string $id)
    {
        try {
            $route = RouteService::destroy($id);

            return $this->sendResponse(['route' => $route]);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), "Falha ao excluir a Rota", $th->getCode());
        }
    }

    public function showByAutomobileId(string $id)
    {
        try {
            $routes = RouteService::showByAutomobileId($id);

            return $this->sendResponse(['routes' => $routes]);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), "Falha ao pegar as Rotas", $th->getCode());
        }
    }

    public function showByDriverId(string $id)
    {
        try {
            $routes = RouteService::showByDriverId($id);

            return $this->sendResponse(['routes' => $routes]);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), "Falha ao pegar as Rotas", $th->getCode());
        }
    }
}
