<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auditLogs = AuditLog::with('user:id,name')->paginate(10);
        return view('admin.audit_log.index', compact('auditLogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.audit_log.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'user_id' => 'required|exists:users,id',
            'action' => 'required|string|max:255',
            'data' => 'nullable|array',
        ]);
        AuditLog::create($validated);
        return redirect()->route('admin.audit_log.index')->with('success', 'Audit Log Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $auditLogs = AuditLog::with('user:id,name')
            ->findOrFail($id);
        return view('admin.audit_log.show', compact('auditLogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $auditLog = AuditLog::with('user:id,name')
            ->findOrFail($id);
        return view('admin.audit_log.edit', compact('auditLog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'user_id' => 'required|exists:users,id',
            'action' => 'required|string|max:255',
            'data' => 'nullable|array',
        ]);
        $auditLog = AuditLog::findOrFail($id);
        $auditLog->update($validated);
        return redirect()->route('admin.audit_log.index')->with('success', 'Audit Log Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $auditLog = AuditLog::findOrFail($id);
        $auditLog->delete();
        return redirect()->route('admin.audit_log.index')->with('success', 'Audit Log Deleted Successfully');
    }
}
