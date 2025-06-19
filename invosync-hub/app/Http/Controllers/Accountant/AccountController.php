<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Company;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::with('company')->paginate(10);
        return view('accountant.account.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accounts = Account::all();
        return view('accountant.account.create', compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id'=> 'required|exists:companies,id',
            'name'=> 'nullable|string|max:50',
            'type'=> 'nullable|string|max:50',
            'balance'=> 'nullable|numeric|max:50'
        ]);

        Account::create($validated);
        return redirect()->action('accountant.account.index')->with('success', 'Account Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $account = Account::with('account:id')->findOrFail($id);
        return view('accountant.account.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $account = Account::with('account:id')->findOrFail($id);
        return view('accountant.account.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validated = $request->validate([
            'company_id'=> 'required|exists:companies,id',
            'name'=> 'nullable|string|max:50',
            'type'=> 'nullable|string|max:50',
            'balance'=> 'nullable|numeric|max:50'
        ]);

        $account = Account::findOrFail($id);
        Account::update($account);
        return redirect()->route('accountant.account.index', $id)->with('success', 'Account Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = Account::findOrFail($id);
        Account::delete($account);
        return redirect()->route('accountant.account.index')->with('success', 'Account Deleted Successfully');
    }
}
