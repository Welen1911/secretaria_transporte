<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Resource\BaseController;
use App\Http\Requests\TurnRequest;
use App\Models\Turn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurnController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $turns = Turn::query()
            ->when($request->filled('deleted'), function ($query) {
                return $query->withTrashed();
            })->get();

        return $this->sendResponse(['turns' => $turns], "Turnos Encontrados", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TurnRequest $request)
    {
        try {
            DB::beginTransaction();
            $turn = Turn::create($request->all());
            DB::commit();
            return $this->sendResponse(['turn' => $turn], "Turno Criado com Sucesso", 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao cadastrar o Turno", $th->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        try {
            $turn = Turn::query()
                ->when($request->filled('deleted'), function ($query) {
                    return $query->withTrashed();
                })->find($id);
            if (!$turn) {
                throw new \Exception('Turno não encontrado', 404);
            }

            return $this->sendResponse(['turn' => $turn], "", 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao buscar o Turno", $th->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TurnRequest $request, Turn $turn)
    {
        try {
            DB::beginTransaction();
            if (!$turn) {
                throw new \Exception('Turno não encontrado', 404);
            }

            $turn->update($request->all());
            DB::commit();
            return $this->sendResponse(['turn' => $turn], "Turno Atualizado com Sucesso", 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao atualizar o Turno", $th->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $turn = Turn::find($id);

            if (!$turn) {
                throw new \Exception('Turno não encontrado', 404);
            }

            $turn->delete();
            DB::commit();
            return $this->sendResponse(['turn' => $turn], "Turno Deletado com Sucesso", 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao deletar o Turno", $th->getCode());
        }
    }
}
