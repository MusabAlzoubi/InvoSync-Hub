<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvoiceItem;

class InvoiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoiceItems = InvoiceItem::with('invoice:id,invoice_number,issue_date', 'product:id,name')
            ->paginate(10);
        return view('accountant.invoice_item.index', compact('invoiceItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $invoiceItems = InvoiceItem::paginate(10);
        return view('accountant.invoice_item.create', compact('invoiceItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'description' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax_rate' => 'nullable|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
            'line_total' => 'nullable|numeric|min:0',
        ]);

        $invoiceItem = InvoiceItem::create($validated);
        return redirect()->route('accountant.invoice_item.index')->with('success','Invoice Item Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoiceItem = InvoiceItem::with('invoice:id')
            ->findOrFail($id);
        return view('accountant.invoice_item.show', compact('invoiceItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoiceItem = InvoiceItem::with('invoice:id')
            ->findOrFail($id);
        return view('accountant.invoice_item.edit', compact('invoiceItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'description' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax_rate' => 'nullable|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
            'line_total' => 'nullable|numeric|min:0',
        ]);

        $invoiceItem = InvoiceItem::findOrFail($id);
        $invoiceItem->update($validated);
        return redirect()->route('accountant.invoice_item.index', $id)->with('success', 'Invoice Item Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoiceItem = InvoiceItem::findOrFail($id);
        $invoiceItem->delete();
        return redirect()->route('accountant.invoice_item.index')->with('success', 'Invoice Item Deleted Successfully');
    }
}
