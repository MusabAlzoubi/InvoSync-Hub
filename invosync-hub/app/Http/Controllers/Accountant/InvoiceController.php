<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoice = Invoice::with('company:id,name', 'user:id,name', 'customer:id,name')
            ->paginate(10);

            return view('accountant.invoice.index', compact('invoice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $invoices = Invoice::paginate(10);
        return view('accountant.invoice.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'company_id' => 'required|exists:companies,id',
        'user_id' => 'required|exists:users,id',
        'customer_id' => 'required|exists:customers,id',
        'invoice_number' => 'nullable|string|max:50',
        'type' => 'nullable|string|max:50',
        'original_invoice_id' => 'nullable|exists:invoices,id',
        'issue_date' => 'required|date',
        'payment_method' => 'nullable|string|max:50',
        'subtotal' => 'nullable|numeric',
        'tax_total' => 'nullable|numeric',
        'total' => 'nullable|numeric',
        'currency' => 'nullable|string|max:50',
        'status' => 'nullable|string|max:50',
        'national_uuid' => 'nullable|string|max:50',
        'digital_signature' => 'nullable|string|max:50',
        'qr_code_data' => 'required|string',
        'notes' => 'nullable|string|max:50',
        'sent_at' => 'required|date',
        'validated_at' => 'required|date'
        ]);

        Invoice::create($validated);
        return redirect()->route('accountant.invoice.index')->with('success','Invoice Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::with('company:id,name','user:id,name', 'customer:id,name')->findOrFail($id);

        return view('accountant.invoice.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::with('company:id,name','user:id,name', 'customer:id,name')->findOrFail($id);

        return view('accountant.invoice.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
        'company_id' => 'required|exists:companies,id',
        'user_id' => 'required|exists:users,id',
        'customer_id' => 'required|exists:customers,id',
        'invoice_number' => 'nullable|string|max:50',
        'type' => 'nullable|string|max:50',
        'original_invoice_id' => 'nullable|exists:invoices,id',
        'issue_date' => 'required|date',
        'payment_method' => 'nullable|string|max:50',
        'subtotal' => 'nullable|numeric',
        'tax_total' => 'nullable|numeric',
        'total' => 'nullable|numeric',
        'currency' => 'nullable|string|max:50',
        'status' => 'nullable|string|max:50',
        'national_uuid' => 'nullable|string|max:50',
        'digital_signature' => 'nullable|string|max:50',
        'qr_code_data' => 'required|string',
        'notes' => 'nullable|string|max:50',
        'sent_at' => 'required|date',
        'validated_at' => 'required|date'
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->update($validated);
        return redirect()->route('accountant.invoice.edit', $id)->with('success', 'Invoice Updated Successfully');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::with('company:id,name','user:id,name', 'customer:id,name')->findOrFail($id);
        $invoice->delete();
        return redirect()->route('accountant.invoice.index')->with('success', 'Invoice Deleted Successfully');

    }
}
