<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reconciliation;

class ReconciliationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reconciliations = Reconciliation::with('bankAccount:id,account_name')
            ->paginate(10);
        return view('accountant.reconciliation.index', compact('reconciliations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reconciliations = Reconciliation::paginate(10);
        return view('accountant.reconciliation.create', compact('reconciliations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        Reconciliation::create($validated);
        return redirect()->route('accountant.reconciliation.index')->with('success', 'Reconciliation Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reconciliations = Reconciliation::with('bankAccount:id,account_name')
            ->findOrFail($id);
        return view('accountant.reconciliation.show', compact('reconciliations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reconciliation = Reconciliation::with('bankAccount:id,account_name')
            ->findOrFail($id);
        return view('accountant.reconciliation.edit', compact('reconciliation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $reconciliation = Reconciliation::findOrFail($id);
        $reconciliation->update($validated);
        return redirect()->route('accountant.reconciliation.index')->with('success', 'Reconciliation Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reconciliation = Reconciliation::findOrFail($id);
        $reconciliation->delete();
        return redirect()->route('accountant.reconciliation.index')->with('success', 'Reconciliation Deleted Successfully');
    }
}
