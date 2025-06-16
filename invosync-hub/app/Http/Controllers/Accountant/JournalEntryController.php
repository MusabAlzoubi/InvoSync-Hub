<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JournalEntry;
use App\Models\Journal;
use App\Models\Account;

class JournalEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $journalEntries = JournalEntry::with(['journal', 'account'])->get();
        return view('accountant.journal_entries.index', compact('journalEntries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $account = Account::all();
        $journal = Journal::all();

        return view('accountant.journal_entries.create', compact('account', 'journal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'journal_id' => 'required|exists:journals,id',
            'account_id' => 'required|exists:accounts,id',
            'debit' => 'nullable|numeric|min:0',
            'credit' => 'nullable|numeric|min:0',
            'entry_date' => 'required|date',
        ]);

        JournalEntry::create($validated);

        return redirect()->route('accountant.journal-entries.index')->with('success', 'Journal Entry created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entry = JournalEntry::with(['journal', 'account'])->findOrFail($id);
        return view('accountant.journal_entries.show', compact('entry'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $entry = JournalEntry::with(['journal', 'account'])->findOrFail($id);
        $accounts = Account::all();
        $journals = Journal::all();

        return view('accountant.journal_entries.edit', compact('entry', 'accounts', 'journals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $entry = JournalEntry::findOrFail($id);

        $validated = $request->validate([
            'journal_id' => 'required|exists:journals,id',
            'account_id' => 'required|exists:accounts,id',
            'debit' => 'nullable|numeric|min:0',
            'credit' => 'nullable|numeric|min:0',
            'entry_date' => 'required|date',
        ]);

        $entry->update($validated);

        return redirect()->route('accountant.journal-entries.index')->with('success', 'Journal Entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $entry = JournalEntry::findOrFail($id);
        $entry->delete();

        return redirect()->route('accountant.journal-entries.index')->with('success', 'Journal Entry deleted successfully.');
    }
}
