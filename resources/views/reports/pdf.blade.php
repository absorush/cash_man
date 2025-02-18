<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>گزارش معاملات پولي</title>
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
            direction: rtl;
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            font-size: 14px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }
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
                <th>امد</th>
                <th>رفت</th>
                <th>موجودی</th>
                <th>ملاحظه</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entries as $entry)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($entry->date)->format('Y-m-d') }}</td>
                    <td>{{ $entry->account->name ?? 'نامشخص' }}</td>
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

    <div class="footer">
        <h3>مجموع موجودی به تفکیک اسعار:</h3>
        @foreach($balances as $currency => $total)
            <p>{{ $currency }}: {{ number_format($total, 2) }}</p>
        @endforeach
    </div>
</body>
</html>
