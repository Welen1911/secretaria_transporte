<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Resource\BaseController;
use App\Http\Requests\AutoMobileRequest;
use App\Models\AutoMobile;
use App\Services\AutoMobileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutoMobileController extends BaseController
{
    // __construct()
    // {
    //     $this->middleware('auth:sanctum')->except(['index', 'show', 'getByTurnAndCapacitiy']);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $autoMobiles = AutoMobile::query()
            ->when($request->filled('deleted'), function ($query) {
                return $query->withTrashed();
            })->get();

        return $this->sendResponse(['auto_mobiles' => $autoMobiles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AutoMobileRequest $request)
    {
        try {
            DB::beginTransaction();
            $autoMobile = AutoMobile::create($request->all());
            DB::commit();

            return $this->sendResponse(['automobile' => $autoMobile], "Automóvel Criado com Sucesso", 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao cadastrar o Automóvel: ".$request->model, $th->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        try {
            $autoMobile = AutoMobile::query()
                ->when($request->filled('deleted'), function ($query) {
                    return $query->withTrashed();
                })->find($id);

            if (!$autoMobile) {
                throw new \Exception('Automóvel não encontrado', 404);
            }
            return $this->sendResponse(['automobile' => $autoMobile], "", 200);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), "Falha ao buscar o Automóvel", $th->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AutoMobileRequest $request, AutoMobile $autoMobile)
    {
        try {
            DB::beginTransaction();

            if (!$autoMobile) {
                throw new \Exception("Automóvel não encontrado", 404);
            }
            $autoMobile->update($request->all());

            DB::commit();
            return $this->sendResponse(['automobile' => $autoMobile], "", 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao atualizar o Automóvel: ".$request->model, $th->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $autoMobile = AutoMobile::find($id);

            if (!$autoMobile) {
                throw new \Exception("Automóvel não encontrado", 404);
            }

            $autoMobile->delete();

            DB::commit();
            return $this->sendResponse(['automobile' => $autoMobile], "", 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao deletar o Automóvel", $th->getCode());
        }
    }

    public function getByTurnAndCapacitiy(string $turnId, string $capacity)
    {
        $autoMobiles = AutoMobileService::getByTurnCapacity($capacity, $turnId);

        return response(['autoMobiles' => $autoMobiles], 200);
    }
}
