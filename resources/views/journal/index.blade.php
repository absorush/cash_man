<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>روزنامچه (ژورنال)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <!-- Include Select2 CSS & jQuery -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary">روزنامچه (ژورنال)</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Form to Add Journal Entry -->
        <div class="card p-4 shadow">
            <form action="{{ route('journal.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">تاریخ:</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="account" class="form-label">حساب را انتخاب کنید:</label>
                    <select name="account_id" id="account" class="form-select select2" required>
                        <option value="">🔍 جستجو یا انتخاب کنید...</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                </div>
                

                <div class="mb-3">
                    <label class="form-label">توضیحات:</label>
                    <input type="text" name="description" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">واحد پولی:</label>
                    <select name="currency" class="form-select" required>
                        <option value="AFN">افغانی (AFN)</option>
                        <option value="USD">دالر (USD)</option>
                        <option value="EUR">یورو (EUR)</option>
                        <option value="PKR">کلدار (PKR)</option>
                        <option value="Mark">مارک(Mark)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">امد پول:</label>
                    <input type="number" name="debit" class="form-control" step="0.01">
                </div>

                <div class="mb-3">
                    <label class="form-label">رفت پول:</label>
                    <input type="number" name="credit" class="form-control" step="0.01">
                </div>

                <div class="mb-3">
                    <label class="form-label">ملاحظه:</label>
                    <textarea name="remark" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-success">اضافه کردن ثبت</button>
            </form>
        </div>

        <!-- Journal Entries Table -->
        <div class="mt-4">
            <h4>لیست ثبت‌ها</h4>
            <table class="table table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th>تاریخ</th>
                        <th>حساب</th>
                        <th>توضیحات</th>
                        <th>واحد پولی</th>
                        <th>امد</th>
                        <th>رفت</th>
                        <th>موجودی</th>
                        <th>ملاحظه</th>
                        <th>عملیات</th>
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
                            <td>
                                <a href="{{ route('journal.edit', $entry->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                                <form action="{{ route('journal.delete', $entry->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
                                </form>
                            </td>
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
