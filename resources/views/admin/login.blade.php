<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-weight: 600;
        }

        .login-container .form-control {
            border-radius: 5px;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            font-weight: 500;
            padding: 10px 20px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .forgot-password {
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="login-container">
        @if (session('message'))
            <div class="alert alert-info">
                <strong>Info!</strong> {{ session('message') }}
            </div>
        @endif
        <h2>Đăng Nhập</h2>
        <form action="{{ route('admin.checkLogin') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Nhập email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
            </div>
            {{-- <div class="forgot-password">
                <a href="#">Quên mật khẩu?</a>
            </div> --}}
            <button type="submit" class="btn btn-custom w-100">Đăng Nhập</button>
        </form>
    </div>

    <!-- Bootstrap 5 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
