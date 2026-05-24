<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin Access</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { background-color: #0a0a0a; color: #e0e0e0; font-family: 'Plus Jakarta Sans', sans-serif; display: flex; align-items: center; height: 100vh; }
        .login-card { background: #121212; border: 1px solid #2a2a2a; padding: 40px; border-radius: 20px; width: 100%; max-width: 400px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .form-control { background: #1a1a1a; border: 1px solid #2a2a2a; color: #fff; padding: 12px; border-radius: 10px; }
        .form-control:focus { background: #1a1a1a; color: #fff; border-color: #00d1b2; box-shadow: none; }
        .btn-login { background: #00d1b2; color: #000; font-weight: 700; width: 100%; padding: 12px; border-radius: 10px; border: none; margin-top: 20px; transition: 0.3s; }
        .btn-login:hover { background: #00f2cf; transform: translateY(-2px); }
        .accent { color: #00d1b2; }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="login-card">
            <h4 class="fw-bold text-center mb-4">ADMIN <span class="accent">LOGIN</span></h4>
            
            @if($errors->any())
                <div class="alert alert-danger py-2 small" style="background: rgba(255,0,0,0.1); border: 1px solid red; color: #ff8080;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="small text-muted mb-2">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="admin@gowsauto.com" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="small text-muted mb-2">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-login">SIGN IN</button>
            </form>
            
            <div class="text-center mt-4">
                <a href="/" class="text-muted small text-decoration-none">← Back to Store</a>
            </div>
        </div>
    </div>
</body>
</html>