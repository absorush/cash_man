<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JournalEntry;
use App\Models\Account;

class JournalEntryController extends Controller
{
    public function index() {
        $accounts = Account::all(); // Fetch accounts for dropdown
        $entries = JournalEntry::with('account')->get(); // Fetch journal entries

         // Calculate total balance per currency
    $totalBalances = JournalEntry::selectRaw('currency, SUM(debit - credit) as total_balance')
    ->groupBy('currency')
    ->pluck('total_balance', 'currency');

        return view('journal.index', compact('accounts', 'entries','totalBalances'));
    }

    public function edit($id) {
        $entry = JournalEntry::findOrFail($id);
        $accounts = Account::all();
    
        return view('journal.edit', compact('entry', 'accounts'));
    }
    

    public function update(Request $request, $id) {
        $entry = JournalEntry::findOrFail($id);
    
        $request->validate([
            'date' => 'required|date',
            'account_id' => 'required|exists:accounts,id',
            'description' => 'nullable|string',
            'currency' => 'required|string',
            'debit' => 'nullable|numeric|min:0',
            'credit' => 'nullable|numeric|min:0',
            'remark' => 'nullable|string'
        ]);
    
        // Recalculate balance
        $previousBalance = JournalEntry::where('account_id', $request->account_id)
                                       ->where('id', '<', $entry->id)
                                       ->sum(DB::raw('debit - credit'));
        $newBalance = $previousBalance + ($request->debit ?? 0) - ($request->credit ?? 0);
    
        // Update the entry
        $entry->update([
            'date' => $request->date,
            'account_id' => $request->account_id,
            'description' => $request->description,
            'currency' => $request->currency,
            'debit' => $request->debit ?? 0,
            'credit' => $request->credit ?? 0,
            'balance' => $newBalance,
            'remark' => $request->remark
        ]);
    
        return redirect()->route('journal.index')->with('success', 'ثبت با موفقیت ویرایش شد!');
    }

    public function destroy($id) {
        $entry = JournalEntry::findOrFail($id);
        $entry->delete();
    
        return redirect()->route('journal.index')->with('success', 'ثبت با موفقیت حذف شد!');
    }
    


    public function transactions(Request $request) {
        $accounts = Account::all();
        
        // Query journal entries with filtering
        $query = JournalEntry::with('account');
    
        if ($request->filled('account_id')) {
            $query->where('account_id', $request->account_id);
        }
        if ($request->filled('currency')) {
            $query->where('currency', $request->currency);
        }
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('date', [$request->date_from, $request->date_to]);
        }
    
        $entries = $query->get();
    
        // Calculate total balance per currency
        $totalBalances = $entries->groupBy('currency')->map(function ($group) {
            return $group->sum(fn($entry) => $entry->debit - $entry->credit);
        });
    
        return view('journal.transactions', compact('accounts', 'entries', 'totalBalances'));
    }
    


    public function store(Request $request) {
        $request->validate([
            'date' => 'required|date',
            'account_id' => 'required|exists:accounts,id',
            'description' => 'nullable|string',
            'currency' => 'required|string',
            'debit' => 'nullable|numeric|min:0',
            'credit' => 'nullable|numeric|min:0',
            'remark' => 'nullable|string'
        ]);

        // Get the last balance of the selected account
    $lastEntry = JournalEntry::where('account_id', $request->account_id)->orderBy('id', 'desc')->first();
    $previousBalance = $lastEntry ? $lastEntry->balance : 0;

    // Calculate new balance
    $newBalance = $previousBalance + ($request->debit ?? 0) - ($request->credit ?? 0);

    

        // Store the new journal entry
    JournalEntry::create([
        'date' => $request->date,
        'account_id' => $request->account_id,
        'description' => $request->description,
        'currency' => $request->currency,
        'debit' => $request->debit ?? 0,
        'credit' => $request->credit ?? 0,
        'balance' => $newBalance,
        'remark' => $request->remark
    ]);

        return redirect()->route('journal.index')->with('success', 'ثبت جدید اضافه شد!');
    }
}

