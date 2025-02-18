<?php

namespace App\Http\Controllers;
use App\Exports\TransactionsExport;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\JournalEntry;

class ExportController extends Controller
{
    public function exportExcel(Request $request)
    {
        // Get only the filter inputs
        $filters = $request->only(['account_id', 'currency', 'date_from', 'date_to']);
    
        // Pass the filters when creating ReportExport
        return Excel::download(new ReportExport($filters), 'filtered_report.xlsx');
    }
    
    


    public function exportPDF()
    {
        $entries = JournalEntry::with('account')->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('journal.pdf', compact('entries'))
            ->setPaper('a4', 'portrait') // Proper A4 size
            ->setOptions(['defaultFont' => 'dejavusans', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
    
        return $pdf->download('transactions.pdf');
    }
    


}

