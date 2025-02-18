<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>گزارش تراکنش‌ها</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
    
    <div class="text-center my-3">
        
        <a href="{{ route('export.pdf') }}" class="btn btn-danger">📄 خروجی PDF</a>
        <button onclick="window.print()" class="btn btn-info">🖨 چاپ</button>
    </div>
    
    <div class="container mt-5">
        <h2 class="text-center text-primary">گزارش تراکنش‌ها</h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('transactions.index') }}" class="row g-3 mb-4">
            <div class="col-md-3">
                <label class="form-label">انتخاب حساب:</label>
                <select name="account_id" class="form-select">
                    <option value="">همه حساب‌ها</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}" {{ request('account_id') == $account->id ? 'selected' : '' }}>
                            {{ $account->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">واحد پولی:</label>
                <select name="currency" class="form-select">
                    <option value="">همه ارزها</option>
                    <option value="AFN" {{ request('currency') == 'AFN' ? 'selected' : '' }}>افغانی (AFN)</option>
                    <option value="USD" {{ request('currency') == 'USD' ? 'selected' : '' }}>دالر (USD)</option>
                    <option value="EUR" {{ request('currency') == 'EUR' ? 'selected' : '' }}>یورو (EUR)</option>
                    <option value="PKR" {{ request('currency') == 'PKR' ? 'selected' : '' }}>کلدار (PKR)</option>
                    <option value="Mark" {{ request('currency') == 'Mark' ? 'selected' : '' }}>مارک (Mark)</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">از تاریخ:</label>
                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">تا تاریخ:</label>
                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">جستجو</button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">پاک کردن فیلتر</a>
            </div>
        </form>

        <!-- Transactions Table -->
        <div class="card shadow p-3">
            <table class="table table-bordered text-center">
                <thead class="table-primary">
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
                <tfoot>
                    <tr class="table-warning">
                        <td colspan="5" class="text-center fw-bold">مجموع موجودی</td>
                        <td colspan="3">
                            @foreach($totalBalances as $currency => $total)
                                <p>{{ $currency }}: {{ number_format($total, 2) }}</p>
                            @endforeach
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('journal.index') }}" class="btn btn-dark">بازگشت</a>
        </div>
    </div>
</body>
</html>
