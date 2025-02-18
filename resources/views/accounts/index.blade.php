<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت حساب‌ها</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary">📜 لیست حساب‌ها</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Add Account Form -->
        <form action="{{ route('accounts.store') }}" method="POST" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="نام حساب جدید" required>
                <button type="submit" class="btn btn-success">➕ افزودن حساب</button>
            </div>
        </form>

        <!-- Accounts Table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>نام حساب</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accounts as $account)
                    <tr>
                        <td>{{ $account->name }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-warning btn-sm">✏ ویرایش</a>

                            <!-- Delete Button -->
                            <form action="{{ route('accounts.delete', $account->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('آیا مطمئن هستید که می‌خواهید حذف کنید؟')">🗑 حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
