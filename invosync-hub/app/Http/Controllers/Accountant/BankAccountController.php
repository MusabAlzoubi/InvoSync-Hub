<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankAccount;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bankAccounts = BankAccount::with('company')->paginate(10);
        return view('accountant.bank_account.index', compact('bankAccounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bankAccounts = BankAccount::all();
        return view('accountant.bank_account.create', compact('bankAccounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:company,id',
            'account_name' => 'nullable|string|max:50',
            'bank_name' => 'nullable|string|max:50',
            'account_number' => 'nullable|numeric|max:50',
            'balance' => 'nullable|numeric|max:50'
        ]);

        BankAccount::create($validated);
        return redirect()->route('accountant.bank_account.index')->with('success', 'Bank Account Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bankAccount = BankAccount::with('bankAccount:id')->findOrFail($id);
        return view('accountant.bank_account.show', compact('bankAccount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bankAccount = BankAccount::with('bankAccount:id')->findOrFail($id);
        return view('accountant.bank_account.edit', compact('bankAccount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:company,id',
            'account_name' => 'nullable|string|max:50',
            'bank_name' => 'nullable|string|max:50',
            'account_number' => 'nullable|numeric|max:50',
            'balance' => 'nullable|numeric|max:50'
        ]);

        $bankAccount = BankAccount::findOrFail($id);
        BankAccount::update($bankAccount);
        return redirect()->route('accountant.bank_account.index', $id)->with('success', 'Bank Account Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bankAccount = BankAccount::findOrFail($id);
        BankAccount::delete($bankAccount);
        return redirect()->route('accountant.bank_account.index')->with('success', 'Bank Account Deleted Successfully');
    }
}
