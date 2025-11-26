<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PerpusKu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* [ ... CSS ANDA YANG LENGKAP DI SINI ... ] */
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
            padding: 40px 20px;
        }

        .register-container {
            width: 100%;
            max-width: 1200px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Left Section - Illustration */
        .illustration-section {
            background: linear-gradient(135deg, #D32F2F 0%, #7B1F1F 100%);
            padding: 60px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .illustration-section::before {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            top: -150px;
            left: -100px;
            animation: float 7s ease-in-out infinite;
        }

        .illustration-section::after {
            content: '';
            position: absolute;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -80px;
            right: -80px;
            animation: float 9s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        .illustration-content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: #FFFFFF;
            animation: fadeIn 1s ease-out 0.3s both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .illustration-icon {
            width: 130px;
            height: 130px;
            margin: 0 auto 30px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .illustration-icon svg {
            width: 65px;
            height: 65px;
            color: #FFFFFF;
        }

        .illustration-content h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .illustration-content p {
            font-size: 16px;
            font-weight: 300;
            line-height: 1.6;
            opacity: 0.95;
            margin-bottom: 10px;
        }

        .feature-list {
            margin-top: 30px;
            text-align: left;
            max-width: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            animation: slideInLeft 0.6s ease-out both;
        }

        .feature-item:nth-child(1) { animation-delay: 0.5s; }
        .feature-item:nth-child(2) { animation-delay: 0.7s; }
        .feature-item:nth-child(3) { animation-delay: 0.9s; }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .feature-icon {
            width: 24px;
            height: 24px;
            min-width: 24px;
        }

        .feature-text {
            font-size: 14px;
            font-weight: 400;
        }

        /* Right Section - Form */
        .form-section {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-height: 90vh;
            overflow-y: auto;
        }

        .form-section::-webkit-scrollbar {
            width: 8px;
        }

        .form-section::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .form-section::-webkit-scrollbar-thumb {
            background: #D32F2F;
            border-radius: 10px;
        }

        .form-section::-webkit-scrollbar-thumb:hover {
            background: #7B1F1F;
        }

        .logo-header {
            text-align: center;
            margin-bottom: 35px;
            animation: fadeInDown 0.6s ease-out 0.2s both;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .brand-logo {
            margin-bottom: 15px;
        }

        .logo-image {
            height: 55px;
            width: auto;
        }

        .logo-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: #333;
            margin-bottom: 6px;
        }

        .logo-header p {
            font-size: 14px;
            color: #666;
            font-weight: 400;
        }

        form {
            animation: fadeIn 0.6s ease-out 0.4s both;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #D32F2F;
            transition: width 0.3s ease;
            z-index: 1;
        }

        .input-wrapper:focus-within::before {
            width: 100%;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            outline: none;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-input:focus {
            border-color: #D32F2F;
            background: #FFFFFF;
            box-shadow: 0 4px 12px rgba(211, 47, 47, 0.1);
        }

        textarea.form-input {
            min-height: 80px;
            resize: vertical;
            font-family: 'Poppins', sans-serif;
        }

        .error-message {
            color: #D32F2F;
            font-size: 12px;
            margin-top: 5px;
            animation: shake 0.3s ease;
        }

        .error-message.show {
            display: block;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-row .form-group {
            margin-bottom: 0;
        }

        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            overflow: hidden;
        }

        .password-strength.show {
            display: block;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { 
            width: 33%; 
            background: #ff5252; 
        }

        .strength-medium { 
            width: 66%; 
            background: #ffa726; 
        }

        .strength-strong { 
            width: 100%; 
            background: #66bb6a; 
        }

        .password-hint {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        .btn-register {
            width: 100%;
            padding: 15px;
            background: #D32F2F;
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(211, 47, 47, 0.3);
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-register:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-register:hover {
            background: #7B1F1F;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(211, 47, 47, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        .login-link a {
            color: #D32F2F;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #7B1F1F;
            text-decoration: underline;
        }

        /* Mobile Responsive */
        @media (max-width: 968px) {
            .register-container {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .illustration-section {
                display: none;
            }

            .form-section {
                padding: 40px 30px;
                max-height: none;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-row .form-group {
                margin-bottom: 22px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 20px 15px;
            }

            .form-section {
                padding: 30px 20px;
            }

            .logo-image {
                height: 50px;
            }

            .logo-header h1 {
                font-size: 22px;
            }

            .btn-register {
                padding: 13px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">

        <div class="illustration-section">
            <div class="illustration-content">
                <div class="illustration-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                </div>
                {{-- PERUBAHAN KALIMAT DI SINI --}}
                <h2>Ayo, Mulai Eksplorasi Literasi Anda</h2> 
                <p>Daftar sekarang dan buka gerbang menuju koleksi digital terlengkap PerpusKu.</p>
                
                <div class="feature-list">
                    <div class="feature-item">
                        <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="feature-text">Ribuan Koleksi Buku Digital (E-Book)</span>
                    </div>
                    <div class="feature-item">
                        <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="feature-text">Fleksibilitas Baca 24/7</span>
                    </div>
                    <div class="feature-item">
                        <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="feature-text">Akses Lintas Perangkat (Multi-Device)</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-section">

            <div class="logo-header">
                <div class="brand-logo">
                    <img src="{{ asset('images/logo-perpusku.png') }}" alt="Logo PerpusKu" class="logo-image">
                </div>
                {{-- PERUBAHAN KALIMAT DI SINI --}}
                <h1>Registrasi Akun Anggota Baru</h1>
                <p>Lengkapi formulir di bawah ini untuk menjadi anggota PerpusKu.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap</label>
                    <div class="input-wrapper">
                        <input id="name" class="form-input" type="text" 
                            name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                            placeholder="Masukkan nama lengkap">
                    </div>
                    @error('name')
                        <div class="error-message show">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <div class="input-wrapper">
                            <input id="username" class="form-input" type="text" 
                                name="username" value="{{ old('username') }}" required autocomplete="username"
                                placeholder="Username unik">
                        </div>
                        @error('username')
                            <div class="error-message show">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <div class="input-wrapper">
                            <input id="email" class="form-input" type="email" 
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="email@example.com">
                        </div>
                        @error('email')
                            <div class="error-message show">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Nomor Telepon</label>
                    <div class="input-wrapper">
                        <input id="phone" class="form-input" type="text" 
                            name="phone" value="{{ old('phone') }}" autocomplete="tel"
                            placeholder="08xxxxxxxxxx">
                    </div>
                    @error('phone')
                        <div class="error-message show">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="address">Alamat</label>
                    <div class="input-wrapper">
                        <textarea id="address" name="address" 
                            class="form-input" 
                            placeholder="Alamat lengkap (opsional)">{{ old('address') }}</textarea>
                    </div>
                    @error('address')
                        <div class="error-message show">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-wrapper">
                            <input id="password" class="form-input" type="password" 
                                name="password" required autocomplete="new-password"
                                placeholder="Min. 8 karakter">
                        </div>
                        <div class="password-strength">
                            <div class="password-strength-bar"></div>
                        </div>
                        <div class="password-hint">Gunakan kombinasi huruf, angka, dan simbol</div>
                        @error('password')
                            <div class="error-message show">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-wrapper">
                            <input id="password_confirmation" class="form-input" 
                                type="password" name="password_confirmation" required
                                placeholder="Ulangi password">
                        </div>
                        @error('password_confirmation')
                            <div class="error-message show">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn-register">Selesaikan Pendaftaran</button>

                <div class="login-link">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">Login di sini</a>
                </div>
                
            </form>

        </div>
    </div>

    <script>
        // Password strength checker
        const passwordInput = document.getElementById('password');
        const strengthBar = document.querySelector('.password-strength');
        const strengthBarInner = document.querySelector('.password-strength-bar');

        if (passwordInput && strengthBar && strengthBarInner) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                strengthBar.classList.add('show');
                
                let strength = 0;
                if (password.length >= 8) strength++;
                if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
                if (password.match(/[0-9]/)) strength++;
                if (password.match(/[^a-zA-Z0-9]/)) strength++;

                strengthBarInner.className = 'password-strength-bar';
                
                if (strength <= 2) {
                    strengthBarInner.classList.add('strength-weak');
                } else if (strength === 3) {
                    strengthBarInner.classList.add('strength-medium');
                } else {
                    strengthBarInner.classList.add('strength-strong');
                }
            });
        }

        // Password confirmation validator
        const confirmPassword = document.getElementById('password_confirmation');
        if (confirmPassword && passwordInput) {
            confirmPassword.addEventListener('input', function() {
                if (this.value !== passwordInput.value) {
                    this.style.borderColor = '#ff5252';
                } else {
                    this.style.borderColor = '#66bb6a';
                }
            });
        }

        // Smooth input animations
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Button ripple effect
        const btnRegister = document.querySelector('.btn-register');
        if (btnRegister) {
            btnRegister.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                ripple.style.width = ripple.style.height = '100px';
                ripple.style.left = e.clientX - this.offsetLeft - 50 + 'px';
                ripple.style.top = e.clientY - this.offsetTop - 50 + 'px';
                ripple.style.animation = 'ripple 0.6s ease-out';
                ripple.style.pointerEvents = 'none';
                
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        }

        // Phone number formatting
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 13) value = value.slice(0, 13);
                e.target.value = value;
            });
        }
    </script>
</body>
</html>