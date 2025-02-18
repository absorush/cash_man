<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش حساب</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary">✏ ویرایش حساب</h2>

        <form action="{{ route('accounts.update', $account->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">نام حساب:</label>
                <input type="text" name="name" class="form-control" value="{{ $account->name }}" required>
            </div>
            <button type="submit" class="btn btn-success w-100">💾 ذخیره تغییرات</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
