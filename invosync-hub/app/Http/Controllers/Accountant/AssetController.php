<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Asset::with('company:id,name')
            ->paginate(10);
        return view('accountant.asset.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assets = Asset::paginate(10);
        return view('accountant.asset.create', compact('assets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);
        Asset::create($validated);
        return redirect()->route('accountant.asset.index')->with('success', 'Asset Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asset = Asset::with('company:id,name')
            ->findOrFail($id);
        return view('accountant.asset.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $asset = Asset::with('company:id,name')
            ->findOrFail($id);
        return view('accountant.asset.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        $asset = Asset::findOrFail($id);
        $asset->update($validated);
        return redirect()->route('accountant.asset.index')->with('success', 'Asset Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();
        return redirect()->route('accountant.asset.index')->with('success', 'Asset Deleted Successfully');
    }
}
