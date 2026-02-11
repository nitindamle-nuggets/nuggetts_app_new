<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('admin.companies.create', compact('companies'));
    }

    public function store(StoreCompanyRequest $request)
    {
        try {
            Company::create($request->validated());
            return redirect()->route('admin.companies.index')
                ->with('success', 'Company created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while creating the company.');
        }
    }
}
