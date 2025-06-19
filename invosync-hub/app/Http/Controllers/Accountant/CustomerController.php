<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::with('company:id,name')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::paginate(10);
        return view('accountant.customer.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'company_id'   => 'required|exists:companies,id',
        'name'         => 'required|string|max:255',
        'type'         => 'nullable|string|max:50',
        'phone'        => 'nullable|string|max:20',
        'email'        => 'nullable|email|max:255',
        'address'      => 'nullable|string',
        'tax_number'   => 'nullable|string|max:50',
        'national_id'  => 'nullable|string|max:50',
            ]);

        Customer::create($validated);

        return redirect()->route('accountant.customer.index')->with('success', 'Customer Created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::with('company:id,name')->findOrFail($id);
        return view('accountant.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::with('company:id,name')->findOrFail($id);
        return view('accountant.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
        'company_id'   => 'required|exists:companies,id',
        'name'         => 'required|string|max:255',
        'type'         => 'nullable|string|max:50',
        'phone'        => 'nullable|string|max:20',
        'email'        => 'nullable|email|max:255',
        'address'      => 'nullable|string',
        'tax_number'   => 'nullable|string|max:50',
        'national_id'  => 'nullable|string|max:50',
            ]);
        $customer = Customer::findOrFail($id);
        $customer->update($validated);
        return redirect()->route('accountant.customer.index')->with('success', 'Customer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('accountant.customer.index')->with('success', 'Customer Deleted Successfully');
    }
}
