<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierInvoice;

class SupplierInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplierInvoices = SupplierInvoice::with('supplier:id,name')
            ->paginate(10);
        return view('accountant.supplier_invoice.index', compact('supplierInvoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplierInvoices = SupplierInvoice::paginate(10);
        return view('accountant.supplier_invoice.create', compact('supplierInvoices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
        ]);

        SupplierInvoice::create($validated);
        return redirect()->route('accountant.supplier_invoice.index')->with('success', 'Supplier Invoice Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplierInvoice = SupplierInvoice::with('supplier:id,name')
            ->findOrFail($id);
        return view('accountant.supplier_invoice.show', compact('supplierInvoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplierInvoice = SupplierInvoice::with('supplier:id,name')
            ->findOrFail($id);
        return view('accountant.supplier_invoice.edit', compact('supplierInvoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $supplierInvoice = SupplierInvoice::findOrFail($id);
        $supplierInvoice->update($validated);
        return redirect()->route('accountant.supplier_invoice.index')->with('success', 'Supplier Invoice Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplierInvoice = SupplierInvoice::findOrFail($id);
        $supplierInvoice->delete();
        return redirect()->route('accountant.supplier_invoice.index')->with('success', 'Supplier Invoice Deleted Successfully');
    }
}
