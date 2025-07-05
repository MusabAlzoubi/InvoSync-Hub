<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subdomain' => 'required|string|max:255',
            'tax_number' => 'required|string|max:255',
            'uuid' => 'required|string|max:255',
            'jo_user_id' => 'required|string|max:255',
            'jo_api_key' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        Company::create($validated);
        return redirect()->route('admin.company.index')->with('success', 'Company Crrated Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $company = Company::with([
            'users',
            'customers',
            'invoices',
            'settings',
            'suppliers',
            'bankAccounts',
            'budgets',
            'assets',
            'accounts',
            'apiClients',
            'attachments',
            'auditLog',
        ])->findOrFail($id);
        return view('admin.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subdomain' => 'required|string|max:255',
            'tax_number' => 'required|string|max:255',
            'uuid' => 'required|string|max:255',
            'jo_user_id' => 'required|string|max:255',
            'jo_api_key' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);
        $company = Company::findOrFail($id);
        $company = Company::update($validated);
        return redirect()->route('admin.company.index')->with('success', 'Company Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        Company::delete($companies);
        return redirect()->route('admin.company.index')->with('success', 'Company Deleted Successfully');
    }
}
