<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpusku</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 1200px;
            margin: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            min-height: 600px;
        }

        /* Left Section - Illustration */
        .illustration-section {
            background: linear-gradient(135deg, #D32F2F 0%, #7B1F1F 100%);
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #FFFFFF;
            position: relative;
            overflow: hidden;
        }

        .illustration-section::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .illustration-section::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }

        .illustration-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .illustration-icon {
            margin-bottom: 30px;
        }

        .illustration-icon svg {
            width: 120px;
            height: 120px;
            stroke: #FFFFFF;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.1));
        }

        .illustration-content h2 {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .illustration-content p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Right Section - Form */
        .form-section {
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo-image {
            height: 60px;
            object-fit: contain;
        }

        .logo-header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .logo-header p {
            font-size: 14px;
            color: #7f8c8d;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            stroke: #95a5a6;
            transition: stroke 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #2c3e50;
            transition: all 0.3s ease;
            background: #FFFFFF;
        }

        .form-input:focus {
            outline: none;
            border-color: #D32F2F;
            box-shadow: 0 0 0 4px rgba(211, 47, 47, 0.1);
        }

        .form-input:focus + .input-icon {
            stroke: #D32F2F;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border: 2px solid #e0e0e0;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 8px;
        }

        .checkbox-wrapper label {
            font-size: 14px;
            color: #2c3e50;
            cursor: pointer;
            user-select: none;
        }

        .forgot-link {
            font-size: 14px;
            color: #D32F2F;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #7B1F1F;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: #D32F2F;
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(211, 47, 47, 0.3);
        }

        .btn-login:hover {
            background: #7B1F1F;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(123, 31, 31, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #7f8c8d;
        }

        .register-link a {
            color: #D32F2F;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #7B1F1F;
        }

        .error-message {
            color: #D32F2F;
            font-size: 12px;
            margin-top: 6px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
                margin: 0;
                border-radius: 0;
                min-height: 100vh;
            }

            .illustration-section {
                display: none;
            }

            .form-section {
                padding: 40px 24px;
            }

            .logo-header h1 {
                font-size: 24px;
            }

            .form-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .forgot-link {
                align-self: flex-end;
            }
        }

        @media (max-width: 480px) {
            .form-section {
                padding: 32px 20px;
            }

            .logo-icon {
                width: 50px;
                height: 50px;
            }

            .logo-icon svg {
                width: 28px;
                height: 28px;
            }

            .logo-header h1 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Section - Illustration -->
        <div class="illustration-section">
            <div class="illustration-content">
                <div class="illustration-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <h2>Selamat Datang di PerpusKu</h2>
                <p>Platform perpustakaan digital terpercaya untuk akses ribuan koleksi buku, jurnal, dan materi pembelajaran berkualitas. Daftar sekarang dan nikmati kemudahan belajar kapan saja, di mana saja.</p>
            </div>
        </div>

        <!-- Right Section - Form -->
        <div class="form-section">
            <div class="logo-header">
                <div class="brand-logo">
                    <!-- Ganti dengan logo PerpusKu Anda -->
                    <img src="path/to/perpusku-logo.png" alt="Logo PerpusKu" class="logo-image">
                </div>
                <h1>Selamat Datang Kembali!</h1>
                <p>Masuk ke akun PerpusKu Anda untuk melanjutkan pembelajaran dan menjelajahi koleksi buku digital, e-journal, artikel ilmiah, dan berbagai sumber referensi akademik yang tersedia.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email/Username Field -->
    <div class="form-group">
        <label class="form-label" for="login">Email atau Username</label>
        <div class="input-wrapper">
            <input 
                type="text" 
                id="login" 
                name="login" 
                class="form-input" 
                value="{{ old('login') }}"
                placeholder="Masukkan email atau username"
                required
            >
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
        </div>

        @error('login')
            <div class="error-message" style="display:block">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password Field -->
    <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <div class="input-wrapper">
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-input" 
                placeholder="Masukkan password"
                required
            >
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg>
        </div>

        @error('password')
            <div class="error-message" style="display:block">{{ $message }}</div>
        @enderror
    </div>

    <!-- Remember Me & Forgot Password -->
    <div class="form-row">
        <div class="checkbox-wrapper">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Ingat Saya</label>
        </div>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="forgot-link">
                Lupa Password?
            </a>
        @endif
    </div>

    <!-- Login Button -->
    <button type="submit" class="btn-login">Login</button>

    <!-- Register Link -->
    <div class="register-link">
        Belum punya akun? 
        @if (Route::has('register'))
            <a href="{{ route('register') }}">Daftar Sekarang</a>
        @endif
        dan mulai petualangan literasi digital Anda!
    </div>
</form>

        </div>
    </div>

    <script>
        // Form validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const login = document.getElementById('login');
            const password = document.getElementById('password');
            const loginError = document.getElementById('loginError');
            const passwordError = document.getElementById('passwordError');
            
            let isValid = true;
            
            // Reset errors
            loginError.classList.remove('show');
            passwordError.classList.remove('show');
            login.style.borderColor = '#e0e0e0';
            password.style.borderColor = '#e0e0e0';
            
            // Validate login
            if (!login.value.trim()) {
                loginError.classList.add('show');
                login.style.borderColor = '#D32F2F';
                isValid = false;
            }
            
            // Validate password
            if (!password.value.trim()) {
                passwordError.classList.add('show');
                password.style.borderColor = '#D32F2F';
                isValid = false;
            }
            
            if (isValid) {
                alert('Login berhasil! (Demo)');
                // Here you would normally submit to your Laravel backend
            }
        });

        // Clear error on input
        document.getElementById('login').addEventListener('input', function() {
            document.getElementById('loginError').classList.remove('show');
            this.style.borderColor = '#e0e0e0';
        });

        document.getElementById('password').addEventListener('input', function() {
            document.getElementById('passwordError').classList.remove('show');
            this.style.borderColor = '#e0e0e0';
        });
    </script>
</body>
</html>