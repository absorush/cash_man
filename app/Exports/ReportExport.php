<?php

namespace App\Exports;

use App\Models\JournalEntry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters = []) // Default to empty array
    {
        $this->filters = $filters;
    }

    public function collection()
{
    $query = JournalEntry::with('account'); // Ensure account relation is loaded

    // Apply filters
    if (!empty($this->filters['account_id'])) {
        $query->where('account_id', $this->filters['account_id']);
    }
    if (!empty($this->filters['currency'])) {
        $query->where('currency', $this->filters['currency']);
    }
    if (!empty($this->filters['date_from']) && !empty($this->filters['date_to'])) {
        $query->whereBetween('date', [$this->filters['date_from'], $this->filters['date_to']]);
    }

    return $query->get()->map(function ($entry) {
        return [
            'date' => $entry->date,
            'account_name' => $entry->account ? $entry->account->name : 'نامشخص', // Convert account_id to account name
            'description' => $entry->description,
            'currency' => $entry->currency,
            'debit' => $entry->debit,
            'credit' => $entry->credit,
            'balance' => $entry->balance,
            'remark' => $entry->remark, // Add remark column
        ];
    });
}

public function headings(): array
{
    return ['تاریخ', 'نام حساب', 'توضیحات', 'واحد پولی', 'امد', 'رفت', 'موجودی', 'ملاحظه'];
}

}
