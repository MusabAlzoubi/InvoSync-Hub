<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Journal;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $journals = Journal::with('journalEntries')->paginate(10);
        return view('accountant.journal.index', compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $journals = Journal::paginate(10);
        return view('accountant.journal.create', compact('journals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'=>'required|string|max:255'
        ]);

        Journal::create($validated);

        return redirect()->route('journal.index')->with('success', 'Journal Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $journal = Journal::with(['journalEntries:id,journal_id,field1,field2'])->findOrFail($id);

        return view('accountant.journal.show', compact('journal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $journal = Journal::findOrFail($id);
        return view('accountant.journal.edit', compact('journal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255'
        ]);
        $journal = Journal::findOrFail($id);
        $journal->update($validated);
        return redirect()->route('journal.index')->with('success', 'Journal Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $journal = Journal::findOrFail($id);
        $journal->delete();
        return redirect()->route('journal.index')->with('success', 'Journal Deleted Successfully');
    }
}
