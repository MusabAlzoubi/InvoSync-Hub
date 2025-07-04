<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierPayment;

class SupplierPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplierPayments = SupplierPayment::with('supplier:id,name')
            ->paginate(10);
        return view('accountant.supplier_payment.index', compact('supplierPayments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplierPayments = SupplierPayment::paginate(10);
        return view('accountant.supplier_payment.create', compact('supplierPayments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'method' => 'required|string|max:255',
        ]);

        SupplierPayment::create($validated);
        return redirect()->route('accountant.supplier_payment.index')->with('success', 'Supplier Payment Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplierPayment = SupplierPayment::with('supplier:id,name')
            ->findOrFail($id);
        return view('accountant.supplier_payment.show', compact('supplierPayment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplierPayment = SupplierPayment::with('supplier:id,name')
            ->findOrFail($id);
        return view('accountant.supplier_payment.edit', compact('supplierPayment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'method' => 'required|string|max:255',
        ]);

        $supplierPayment = SupplierPayment::findOrFail($id);
        $supplierPayment->update($validated);
        return redirect()->route('accountant.supplier_payment.index')->with('success', 'Supplier Payment Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplierPayment = SupplierPayment::findOrFail($id);
        $supplierPayment->delete();
        return redirect()->route('accountant.supplier_payment.index')->with('success', 'Supplier Payment Deleted Successfully');
    }
}
