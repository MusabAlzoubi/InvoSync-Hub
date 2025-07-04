<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::with('supplier:id,name')
            ->paginate(10);
        return view('accountant.expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expenses = Expense::paginate(10);
        return view('accountant.expense.create', compact('expenses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);

        Expense::create($validated);
        return redirect()->route('accountant.expense.index')->with('success', 'Expense Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $expense = Expense::with('supplier:id,name')
            ->findOrFail($id);
        return view('accountant.expense.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expense::with('supplier:id,name')
            ->findOrFail($id);
        return view('accountant.expense.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->update($validated);
        return redirect()->route('accountant.expense.index')->with('success', 'Expense Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return redirect()->route('accountant.expense.index')->with('success', 'Expense Deleted Successfully');
    }
}
