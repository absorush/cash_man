<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JournalEntry;
use App\Models\Account; // ✅ Import Account Model

use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
class ReportController extends Controller
{

    
    public function index(Request $request)
{
    $query = JournalEntry::with('account');
    
    // Fetch accounts for dropdown
    $accounts = Account::all();  

    // Apply filters
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

    // Calculate total balance for each currency
    $balances = JournalEntry::selectRaw('currency, SUM(debit - credit) as total_balance')
        ->whereIn('id', $entries->pluck('id'))
        ->groupBy('currency')
        ->pluck('total_balance', 'currency');

    // 🔹 Pass `$accounts` to the view
    return view('reports.index', compact('entries', 'balances', 'accounts'));
}

    
  

    
    public function exportPDF(Request $request)
    {
        
    
        $query = JournalEntry::with('account');
    
        // Apply filters properly
        if ($request->filled('account_id')) {
            \Log::info("Filtering by account_id:", [$request->account_id]);
            $query->where('account_id', $request->account_id);
        }
        if ($request->filled('currency')) {
            \Log::info("Filtering by currency:", [$request->currency]);
            $query->where('currency', $request->currency);
        }
        if ($request->filled('date_from') && $request->filled('date_to')) {
            \Log::info("Filtering by date range:", [$request->date_from, $request->date_to]);
            $query->whereBetween('date', [$request->date_from, $request->date_to]);
        }
    
        
    
        // Get only filtered transactions
        $entries = $query->get();
    
        // Calculate total balance for each currency (filtered data only)
        $balances = JournalEntry::selectRaw('currency, SUM(debit - credit) as total_balance')
            ->whereIn('id', $entries->pluck('id'))
            ->groupBy('currency')
            ->pluck('total_balance', 'currency');
    
        // Generate PDF
        $pdf = \Barryvdh\Snappy\Facades\SnappyPdf::loadView('reports.pdf', compact('entries', 'balances'))
            ->setPaper('a4', 'portrait')
            ->setOption('margin-top', '10mm')
            ->setOption('margin-bottom', '10mm')
            ->setOption('margin-left', '10mm')
            ->setOption('margin-right', '10mm');
    
        return $pdf->download('filtered_report.pdf');
    }
    

    
    

    
    



    

    public function exportExcel(Request $request)
{
    $filters = $request->only(['account_id', 'currency', 'date_from', 'date_to']);

    

    return Excel::download(new ReportExport($filters), 'filtered_report.xlsx');
}

}

