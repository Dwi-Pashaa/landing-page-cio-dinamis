<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - CIO Network Solution</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #e8edf5 50%, #f5f0ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        .login-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 48px 40px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.06), 0 10px 20px -5px rgba(0,0,0,0.04), 0 0 0 1px rgba(0,0,0,0.02);
        }
        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid #f1f5f9;
        }
        .login-logo img {
            height: 32px;
            width: auto;
            display: block;
            border-radius: 6px;
            background: rgba(255,255,255,0.95);
            padding: 3px 6px;
        }
        .login-logo .logo-admin {
            font-size: 16px;
            color: #94a3b8;
            font-weight: 500;
            margin-left: 4px;
        }
        .login-title {
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }
        .login-subtitle {
            text-align: center;
            color: #94a3b8;
            font-size: 14px;
            margin-bottom: 32px;
        }
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }
        .input-group-custom {
            position: relative;
        }
        .input-group-custom i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
            pointer-events: none;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 16px 12px 42px;
            border: 1.5px solid #e2e8f0;
            font-size: 14px;
            height: 48px;
            background: #f8fafc;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99,102,241,0.1);
            background: #ffffff;
            outline: none;
        }
        .btn-login {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            transition: all 0.25s;
            cursor: pointer;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(99,102,241,0.35);
        }
        .btn-login:active {
            transform: translateY(0);
        }
        .alert-danger {
            border-radius: 12px;
            font-size: 13px;
            border: none;
            background: #fef2f2;
            color: #dc2626;
            padding: 12px 16px;
        }
        .mb-3 { margin-bottom: 20px; }
        .mb-4 { margin-bottom: 24px; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <img src="{{ asset('img/logo.jpg') }}" alt="CIO">
            <img src="{{ asset('img/logo_2.jpeg') }}" alt="CIO">
        </div>
        <div class="login-title">Selamat Datang Kembali</div>
        <div class="login-subtitle">Masuk ke panel admin CIO Network Solution</div>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation me-2"></i> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ url('/cms/login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="admin@cionetwork.id" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="******" required>
                </div>
            </div>
            <button type="submit" class="btn-login">
                <i class="fa-solid fa-right-to-bracket"></i> Masuk
            </button>
        </form>
    </div>
</body>
</html>
