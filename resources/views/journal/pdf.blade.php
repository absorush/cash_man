<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>گزارش تراکنش‌ها</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; direction: rtl; text-align: right; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; font-size: 14px; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>گزارش تراکنش‌ها</h2>
    <table>
        <thead>
            <tr>
                <th>تاریخ</th>
                <th>حساب</th>
                <th>توضیحات</th>
                <th>واحد پولی</th>
                <th>بدهکار</th>
                <th>بستانکار</th>
                <th>موجودی</th>
                <th>ملاحظه</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entries as $entry)
                <tr>
                    <td>{{ $entry->date }}</td>
                    <td>{{ $entry->account->name }}</td>
                    <td>{{ $entry->description }}</td>
                    <td>{{ $entry->currency }}</td>
                    <td>{{ number_format($entry->debit, 2) }}</td>
                    <td>{{ number_format($entry->credit, 2) }}</td>
                    <td>{{ number_format($entry->balance, 2) }}</td>
                    <td>{{ $entry->remark }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
