<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Resource\BaseController;
use App\Http\Requests\DriverRequest;
use App\Models\Driver;
use App\Services\DriverService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $drivers = Driver::query()
            ->when($request->filled('deleted'), function ($query) {
                return $query->withTrashed();
            })->get();

        return $this->sendResponse(['drivers' => $drivers], "Motoristas Encontrados", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DriverRequest $request)
    {
        try {
            DB::beginTransaction();
            $driver = Driver::create($request->all());
            DB::commit();
            return $this->sendResponse(['driver' => $driver], "Motorista Criado com Sucesso", 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao cadastrar o Motorista", $th->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        try {
            $driver = Driver::query()
                ->when($request->filled('deleted'), function ($query) {
                    return $query->withTrashed();
                })->find($id);

            if (!$driver) {
                throw new \Exception('Motorista não encontrado', 404);
            }
            return $this->sendResponse(['driver' => $driver], "", 200);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), "Falha ao buscar o Motorista", $th->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DriverRequest $request, Driver $driver)
    {
        try {
            DB::beginTransaction();
            if (!$driver) {
                throw new \Exception('Motorista não encontrado', 404);
            }
            $driver->update($request->all());
            DB::commit();
            return $this->sendResponse(['driver' => $driver], "Motorista Atualizado com Sucesso", 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao atualizar o Motorista", $th->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $driver = Driver::find($id);

            if (!$driver) {
                throw new \Exception('Motorista não encontrado', 404);
            }
            $driver->delete();
            DB::commit();
            return $this->sendResponse(['driver' => $driver], "Motorista Deletado com Sucesso", 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao deletar o Motorista", $th->getCode());
        }
    }

    public function getByTurnAndCategoryCNH(string $turnId, string $capacity)
    {
        $drivers = DriverService::getByTurnAndCategoryCNH($capacity, $turnId);

        return $this->sendResponse(['drivers' => $drivers]);
    }
}
