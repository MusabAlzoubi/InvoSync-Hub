<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::paginate(10);
        return view('admin.setting.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        Setting::create($validated);
        return redirect()->route('admin.setting.index')->with('success', 'Setting Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $settings = Setting::with('company:id,name')
            ->findOrFail($id);
        return view('admin.setting.show', compact('settings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $setting = Setting::with('company:id,name')
            ->findOrFail($id);
        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        $setting = Setting::findOrFail($id);
        $setting->update($validated);
        return redirect()->route('admin.setting.index')->with('success', 'Setting Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();
        return redirect()->route('admin.setting.index')->with('success', 'Setting Deleted Successfully');
    }
}
