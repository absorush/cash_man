<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مدیریت پشتیبان</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center text-primary mb-4">🔄 مدیریت پشتیبان</h2>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <!-- Restore Backup -->
            <div class="col-md-6">
                <h4 class="mb-3">📂 بازیابی پشتیبان</h4>
                <form action="{{ route('restore.restore') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="backup_file" class="form-label">انتخاب فایل پشتیبان:</label>
                        <select name="backup_file" id="backup_file" class="form-select">
                            @foreach($backupFiles as $backup)
                                <option value="{{ $backup }}">{{ basename($backup) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">🔄 بازیابی</button>
                </form>
            </div>

            <!-- Create Backup -->
            <div class="col-md-6">
                <h4 class="mb-3">💾 گرفتن پشتیبان</h4>
                <form action="{{ route('backup.create') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success w-100">📌 ایجاد پشتیبان</button>
                </form>
            </div>
        </div>

        <hr>

        <!-- Backup List -->
        <h5 class="text-secondary">📜 لیست پشتیبان‌ها:</h5>
        <ul class="list-group mt-2">
            @foreach($backupFiles as $backup)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ basename($backup) }}
                    <a href="{{ route('backup.download', ['file' => $backup]) }}" class="btn btn-sm btn-primary">⬇ دانلود</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
