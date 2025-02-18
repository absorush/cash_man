<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>به سیستم مدیریت مالی خوش آمدید</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <style>
        body {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: white;
            font-family: 'Tajawal', sans-serif;
            text-align: center;
        }
        .welcome-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .btn-custom {
            background: #ff9800;
            color: white;
            font-size: 1.2rem;
            padding: 10px 30px;
            border-radius: 30px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: #ff5722;
            transform: scale(1.05);
        }
        .logo {
            width: 200px;
            height: 200px;
            margin-bottom: 20px;
            border-radius: 50%;
        }
        .developer-info {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%); /* Centers horizontally */
    font-size: 18px; /* Increase size */
    color: black; /* Set text color */
    font-weight: bold; /* Make it more visible */
    text-align: center;
    opacity: 1; /* Full visibility */
}

    </style>
</head>
<body>

    <div class="container welcome-container">
        <!-- Logo -->
        <img src="{{ asset('images/logo.jpeg') }}" alt="Cash Management Logo" class="logo"> 

        <h1 class="mb-3">🎉 به سیستم مدیریت مالی خوش آمدید</h1>
        <p class="mb-4">مدیریت آسان حساب‌ها، معاملات پولي و گزارش‌های مالی</p>
        
        <a href="{{ route('login') }}" class="btn btn-custom">ورود به سیستم</a>
    </div>

    <!-- Developer Info -->
    <div class="developer-info">
        <p>طراحي شده توسط <strong>عبدالله سروش </strong> | 2025</p>
    </div>

</body>
</html>
