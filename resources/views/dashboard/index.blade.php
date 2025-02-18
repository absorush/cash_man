<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📊 داشبورد مدیریت پول</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            font-family: 'Arial', sans-serif;
        }
        .dashboard-card {
            background: white;
            color: #2a5298;
            border-radius: 12px;
            padding: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .dashboard-icon {
            font-size: 40px;
        }
        .btn-custom {
            background: #2a5298;
            color: white;
            border-radius: 8px;
            padding: 10px 15px;
        }
        .btn-custom:hover {
            background: #1e3c72;
        }
    </style>
</head>
<body>
    <div class="container text-center mt-5">
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">🚪 خروج از سیستم</button>
        </form>
        
        <h1 class="fw-bold">📊 به سیستم مدیریت پول خوش آمدید</h1>
        <p class="lead">یک راه حل کامل برای پیگیری درآمد و هزینه‌های شما</p>

        <div class="row mt-4">
            <div class="col-md-4 mb-3">
                <div class="dashboard-card shadow">
                    <div class="dashboard-icon">💰</div>
                    <h4>مدیریت حساب‌ها</h4>
                    <a href="{{ route('accounts.index') }}" class="btn btn-custom w-100">ورود</a>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="dashboard-card shadow">
                    <div class="dashboard-icon">📑</div>
                    <h4>ثبت معاملات پولی</h4>
                    <a href="{{ route('journal.index') }}" class="btn btn-custom w-100">ورود</a>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="dashboard-card shadow">
                    <div class="dashboard-icon">📊</div>
                    <h4>گزارش‌ها</h4>
                    <a href="{{ route('reports.index') }}" class="btn btn-custom w-100">ورود</a>
                </div>
            </div>

            <div class="col-md-4 mb-3 offset-md-4">
                <div class="dashboard-card shadow">
                    <div class="dashboard-icon">🔄</div>
                    <h4>مدیریت پشتیبان</h4>
                    <a href="{{ route('restore.index') }}" class="btn btn-custom w-100">ورود</a>
                </div>
            </div>
        </div>

        <hr class="mt-4" style="border-color: rgba(255, 255, 255, 0.5);">
        <p class="text-light">© 2025 سیستم مدیریت پول | طراحی شده توسط عبدالله سروش || abdullah.sorush72@gmail.com</p>
    </div>
</body>
</html>
