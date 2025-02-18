<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش ثبت</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary">ویرایش ثبت دفتر کل</h2>

        <div class="card p-4 shadow">
            <form action="{{ route('journal.update', $entry->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">تاریخ:</label>
                    <input type="date" name="date" class="form-control" value="{{ $entry->date }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">حساب:</label>
                    <select name="account_id" class="form-select" required>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}" {{ $entry->account_id == $account->id ? 'selected' : '' }}>
                                {{ $account->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">توضیحات:</label>
                    <input type="text" name="description" class="form-control" value="{{ $entry->description }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">واحد پولی:</label>
                    <select name="currency" class="form-select" required>
                        <option value="AFN" {{ $entry->currency == 'AFN' ? 'selected' : '' }}>افغانی (AFN)</option>
                        <option value="USD" {{ $entry->currency == 'USD' ? 'selected' : '' }}>دالر (USD)</option>
                        <option value="EUR" {{ $entry->currency == 'EUR' ? 'selected' : '' }}>یورو (EUR)</option>
                        <option value="EUR" {{ $entry->currency == 'EUR' ? 'selected' : '' }}>کلدار (PKR)</option>
                        <option value="EUR" {{ $entry->currency == 'EUR' ? 'selected' : '' }}>مارک (Mark)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">بدهکار:</label>
                    <input type="number" name="debit" class="form-control" step="0.01" value="{{ $entry->debit }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">بستانکار:</label>
                    <input type="number" name="credit" class="form-control" step="0.01" value="{{ $entry->credit }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">ملاحظه:</label>
                    <textarea name="remark" class="form-control">{{ $entry->remark }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">بروزرسانی</button>
                <a href="{{ route('journal.index') }}" class="btn btn-secondary">لغو</a>
            </form>
        </div>
    </div>
</body>
</html>
