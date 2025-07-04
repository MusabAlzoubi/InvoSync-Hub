<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('customer:id,name')
            ->paginate(10);
        return view('accountant.payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $payments = Payment::paginate(10);
        return view('accountant.payment.create', compact('payments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'method' => 'required|string|max:255',
        ]);

        Payment::create($validated);
        return redirect()->route('accountant.payment.index')->with('success', 'Payment Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::with('customer:id,name')
            ->findOrFail($id);
        return view('accountant.payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment = Payment::with('customer:id,name')
            ->findOrFail($id);
        return view('accountant.payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'method' => 'required|string|max:255',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update($validated);
        return redirect()->route('accountant.payment.index')->with('success', 'Payment Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->route('accountant.payment.index')->with('success', 'Payment Deleted Successfully');
    }
}
