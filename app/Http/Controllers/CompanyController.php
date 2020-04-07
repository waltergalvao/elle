<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyCollection;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * @return CompanyCollection
     */
    public function index()
    {
        return new CompanyCollection(Company::all());
    }
}
