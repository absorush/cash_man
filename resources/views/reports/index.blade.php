<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>گزارشات مالی</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include Select2 CSS & jQuery -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary">گزارشات مالی</h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('reports.index') }}" class="row g-3 mb-4">
            <div class="col-md-3">
                <label for="account" class="form-label">🔍 انتخاب حساب:</label>
                <select name="account_id" id="account" class="form-select select2">
                    <option value="">🔍 جستجو یا انتخاب کنید...</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
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
                    <option value="MARK" {{ request('currency') == 'MARK' ? 'selected' : '' }}>مارک (MARK)</option>
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
                <a href="{{ route('reports.index') }}" class="btn btn-secondary">پاک کردن فیلتر</a>
            </div>
        </form>

        <!-- Reports Table -->
        <div class="card p-4 shadow">
            <table class="table table-bordered">
                <thead class="table-primary">
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
                    <tr class="table-primary">
                        <td colspan="6" class="text-end"><strong>مجموع موجودی</strong></td>
                        <td colspan="2">
                            @foreach($balances as $currency => $total)
                                <p><strong>{{ $currency }}:</strong> {{ number_format($total, 2) }}</p>
                            @endforeach
                        </td>
                    </tr>
                </tfoot>
                
                

            </table>
        </div>

        <!-- Export Buttons -->
        <div class="d-flex justify-content-center gap-2 mt-3">
            <form method="GET" action="{{ route('reports.export.excel') }}">
                <input type="hidden" name="account_id" value="{{ request('account_id') }}">
                <input type="hidden" name="currency" value="{{ request('currency') }}">
                <input type="hidden" name="date_from" value="{{ request('date_from') }}">
                <input type="hidden" name="date_to" value="{{ request('date_to') }}">
                <button type="submit" class="btn btn-success">📂 خروجی اکسل</button>
            </form>
        
            <form action="{{ route('reports.export.pdf') }}" method="GET" style="display: inline;">
                <input type="hidden" name="account_id" value="{{ request('account_id') }}">
                <input type="hidden" name="currency" value="{{ request('currency') }}">
                <input type="hidden" name="date_from" value="{{ request('date_from') }}">
                <input type="hidden" name="date_to" value="{{ request('date_to') }}">
                <button type="submit" class="btn btn-danger">📄 خروجی PDF</button>
            </form>
            
        
            <button onclick="window.print()" class="btn btn-info">🖨 چاپ</button>
        </div>
        
    </div>
</body>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%', 
            placeholder: "🔍 جستجو یا انتخاب کنید...",
            allowClear: true
        });
    });
</script>

</html>
