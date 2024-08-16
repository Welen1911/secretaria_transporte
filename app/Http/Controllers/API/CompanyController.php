<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Resource\BaseController;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companies = Company::query()
            ->when($request->filled('deleted'), function ($query) {
                return $query->withTrashed();
            })->get();

        return response(['companies' => $companies], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {   
        try {
            DB::beginTransaction();
            $company = Company::create($request->all());
            DB::commit();

            return $this->sendResponse(['company' => $company], "Empresa Criada com Sucesso", 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao cadastrar a Empresa: ".$request->name, $th->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {       
        try {
            $company = Company::query()
                ->when($request->filled('deleted'), function ($query) {
                    return $query->withTrashed();
                })->find($id);
            
            if (!$company) {
                throw new \Exception('Empresa não encontrada', 404);
            }
            return $this->sendResponse(['company' => $company], "", 200);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), "Falha ao buscar a Empresa", ($th->getCode() != 0) ? $th->getCode() : 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        try {
            DB::beginTransaction();
            if (!$company) {
                throw new \Exception('Empresa não encontrada', 404);
            }

            $company->update($request->all());

            DB::commit();

            return $this->sendResponse(['company' => $company], "Empresa Atualizada com Sucesso", 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao atualizar a Empresa", $th->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $company = Company::find($id);

            if (!$company) {
                throw new \Exception('Empresa não encontrada', 404);
            }

            $company->delete();

            DB::commit();

            return $this->sendResponse(['company' => $company], "Empresa Removida com Sucesso", 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage(), "Falha ao remover a Empresa", $th->getCode());
        }
    }
}
