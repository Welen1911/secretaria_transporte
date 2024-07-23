<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();

        return response(['companies' => $companies], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $company = Company::create($request->all());


        return response(['company' => $company], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::find($id);

        if (!$company) {

            $company = Company::where('cnpj', $id)->first();

            if (!$company) {
                return response('', 404);
            }
        }

        return response(['company' => $company], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, string $id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response('', 404);
        }

        $company->update($request->all());

        return response(['company' => $company], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response('', 404);
        }

        $company->delete();

        return response(['company' => $company], 200);
    }
}
