<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Budget;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $budgets = Budget::with('company:id,name')
            ->paginate(10);
        return view('accountant.budget.index', compact('budgets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $budgets = Budget::paginate(10);
        return view('accountant.budget.create', compact('budgets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'year' => 'required|integer|min:2000|max:2100',
            'total_income' => 'required|numeric|min:0',
            'total_expense' => 'required|numeric|min:0',
        ]);

        Budget::create($validated);
        return redirect()->route('accountant.budget.index')->with('success', 'Budget Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $budgets = Budget::with('company:id,name')
            ->findOrFail($id);
        return view('accountant.budget.show', compact('budgets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $budget = Budget::with('company:id,name')
            ->findOrFail($id);
        return view('accountant.budget.edit', compact('budget'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'year' => 'required|integer|min:2000|max:2100',
            'total_income' => 'required|numeric|min:0',
            'total_expense' => 'required|numeric|min:0',
        ]);

        $budget = Budget::findOrFail($id);
        $budget->update($validated);
        return redirect()->route('accountant.budget.index')->with('success', 'Budget Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $budget = Budget::findOrFail($id);
        $budget->delete();
        return redirect()->route('accountant.budget.index')->with('success', 'Budget Deleted Successfully');
    }
}
