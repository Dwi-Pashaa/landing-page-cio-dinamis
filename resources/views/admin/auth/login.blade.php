<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PT CIO NETWORK NUSANTARA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .login-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 36px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.1);
        }
        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f1f5f9;
        }
        .login-logo img {
            height: 56px;
            max-width: 100%;
            width: auto;
            display: block;
            object-fit: contain;
            border-radius: 8px;
            padding: 4px 10px;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
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
            color: #64748b;
            font-size: 13.5px;
            margin-bottom: 28px;
            line-height: 1.5;
        }
        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #334155;
            margin-bottom: 6px;
            display: block;
        }
        .input-group-custom {
            position: relative;
        }
        .input-group-custom i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 15px;
            pointer-events: none;
            transition: color 0.2s;
        }
        .input-group-custom .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px 12px 44px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.2s;
            width: 100%;
            background-color: #f8fafc;
            height: 48px;
            color: #1e293b;
        }
        .input-group-custom .form-control:focus {
            background-color: #fff;
            border-color: #4338ca;
            box-shadow: 0 0 0 4px rgba(67, 56, 202, 0.12);
            outline: none;
        }
        .input-group-custom .form-control:focus + i,
        .input-group-custom:focus-within i {
            color: #4338ca;
        }
        .btn-login {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #4338ca 100%);
            border: none;
            border-radius: 12px;
            padding: 13px;
            font-size: 15px;
            font-weight: 700;
            font-family: inherit;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            color: #ffffff;
            cursor: pointer;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(37, 99, 235, 0.45);
            background: linear-gradient(135deg, #172554 0%, #1d4ed8 50%, #3730a3 100%);
            color: #ffffff;
        }
        .btn-login:active {
            transform: translateY(0);
        }
        .alert-danger {
            border-radius: 12px;
            font-size: 13.5px;
            margin-bottom: 20px;
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #b91c1c;
            padding: 12px 16px;
            display: flex;
            align-items: center;
        }
        .mb-3 { margin-bottom: 18px; }
        .mb-4 { margin-bottom: 24px; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <img src="{{ asset('img/logo_baru.jpeg') }}" alt="PT CIO NETWORK NUSANTARA">
        </div>
        <div class="login-title">Selamat Datang Kembali</div>
        <div class="login-subtitle">Masuk ke panel admin PT CIO NETWORK NUSANTARA</div>

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
                    <input type="email" name="email" class="form-control" placeholder="admin@cionetwork.id" value="{{ old('email') }}" required autofocus>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>
            <button type="submit" class="btn-login">
                <i class="fa-solid fa-right-to-bracket"></i> Masuk ke Dashboard
            </button>
        </form>
    </div>
</body>
</html>
