<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * @return CompanyCollection
     */
    public function index()
    {
        return new CompanyCollection(Company::all());
    }

    /**
     * @param string $companyId
     * @return CompanyResource
     */
    public function get(string $companyId)
    {
        $batch = Company::with('contacts')->find($companyId);

        return new CompanyResource($batch);
    }

    /**
     * @param string $companyId
     * @param Request $request
     * @return CompanyResource
     */
    public function update(string $companyId, Request $request)
    {
        $company = Company::findOrFail($companyId);
        $company->fill($request->all());
        $company->save();

        return new CompanyResource($company);
    }
}
