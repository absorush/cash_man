namespace App\Exports;

use App\Models\JournalEntry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return JournalEntry::select('date', 'account_id', 'description', 'currency', 'debit', 'credit', 'balance', 'remark')->get();
    }

    public function headings(): array
    {
        return ['تاریخ', 'حساب', 'توضیحات', 'واحد پولی', 'بدهکار', 'بستانکار', 'موجودی', 'ملاحظه'];
    }
}
