<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PitTel Moto</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-red: #D60A1E;
            --fire-red: #B80818;
            --asphalt: #0F0F0F;
            --gear-gray: #1C1C1E;
            --steel: #333333;
            --light-gray: #CCCCCC;
            --yellow: #F2D544;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            min-height: 100vh;
        }

        .login-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* Left Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--asphalt) 0%, var(--gear-gray) 100%);
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(214, 10, 30, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-logo {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .hero-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-red), var(--fire-red));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            box-shadow: 0 10px 30px rgba(214, 10, 30, 0.3);
        }

        .hero-branding h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0 0 0.5rem 0;
            line-height: 1.2;
        }

        .hero-branding p {
            font-size: 1.1rem;
            color: var(--yellow);
            font-weight: 600;
            margin: 0;
        }

        .hero-mission {
            margin: 3rem 0;
        }

        .hero-mission h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-mission p {
            font-size: 1rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
        }

        .features-list {
            margin: 3rem 0;
        }

        .features-list h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--yellow);
        }

        .feature-item {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            align-items: flex-start;
        }

        .feature-icon {
            font-size: 1.8rem;
            flex-shrink: 0;
        }

        .feature-text h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            margin: 0 0 0.3rem 0;
        }

        .feature-text p {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
        }

        .hero-footer {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .hero-contact {
            display: flex;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .contact-item {
            flex: 1;
            min-width: 150px;
        }

        .contact-label {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 0.5rem;
        }

        .contact-value {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
        }

        /* Right Form Section */
        .form-section {
            background: white;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .form-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(214, 10, 30, 0.05) 0%, transparent 70%);
            pointer-events: none;
        }

        .form-box {
            position: relative;
            z-index: 1;
            max-width: 450px;
        }

        .form-header {
            margin-bottom: 2.5rem;
        }

        .form-header h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--steel);
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #999;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--steel);
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
        }

        input {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border: 2px solid var(--light-gray);
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-red);
            box-shadow: 0 0 0 4px rgba(214, 10, 30, 0.1);
        }

        input::placeholder {
            color: #bbb;
        }

        .error-text {
            color: var(--primary-red);
            font-size: 0.85rem;
            margin-top: 0.4rem;
            display: block;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            gap: 0.75rem;
        }

        .remember-me input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: var(--primary-red);
        }

        .remember-me label {
            margin: 0;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-red), var(--fire-red));
            color: white;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(214, 10, 30, 0.2);
        }

        .btn:hover {
            box-shadow: 0 10px 35px rgba(214, 10, 30, 0.35);
            transform: translateY(-3px);
        }

        .btn:active {
            transform: translateY(-1px);
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
            font-size: 0.95rem;
        }

        .register-link a {
            color: var(--primary-red);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: var(--fire-red);
            text-decoration: underline;
        }

        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            animation: slideDown 0.3s ease;
        }

        .alert-danger {
            background: #ffe5e5;
            color: var(--primary-red);
            border-left: 4px solid var(--primary-red);
        }

        .alert-success {
            background: #e5f5e5;
            color: #28a745;
            border-left: 4px solid #28a745;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .login-wrapper {
                grid-template-columns: 1fr;
            }

            .hero-section {
                padding: 3rem;
                min-height: 400px;
                justify-content: center;
            }

            .hero-branding h1 {
                font-size: 2rem;
            }

            .form-section {
                padding: 3rem;
            }

            .hero-footer {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem;
            }

            .form-section {
                padding: 2rem;
            }

            .form-box {
                max-width: 100%;
            }

            .hero-logo {
                margin-bottom: 2rem;
            }

            .hero-branding h1 {
                font-size: 1.75rem;
            }

            .hero-mission {
                margin: 2rem 0;
            }

            .features-list {
                margin: 2rem 0;
            }

            .form-header h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .hero-section {
                padding: 1.5rem;
            }

            .form-section {
                padding: 1.5rem;
            }

            .hero-branding h1 {
                font-size: 1.5rem;
            }

            .form-header h2 {
                font-size: 1.3rem;
            }

            .feature-item {
                margin-bottom: 1rem;
            }

            .hero-contact {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <div class="hero-logo">
                    <div class="hero-icon">⚙️</div>
                    <div class="hero-branding">
                        <h1>PitTel Moto</h1>
                        <p>Fast & Trusted</p>
                    </div>
                </div>

                <div class="hero-mission">
                    <h2>Solusi Servis Motor Terpercaya</h2>
                    <p>Kelola servis motor Anda dengan mudah. Lacak progres, kelola pembayaran, dan dapatkan notifikasi real-time untuk semua kendaraan Anda.</p>
                </div>

                <div class="features-list">
                    <h3>Fitur Unggulan</h3>
                    <div class="feature-item">
                        <div class="feature-icon">📋</div>
                        <div class="feature-text">
                            <h4>Kelola Servis Mudah</h4>
                            <p>Atur jadwal servis dan track status dengan detail</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🏍️</div>
                        <div class="feature-text">
                            <h4>Monitor Kendaraan</h4>
                            <p>Pantau kondisi motor dan riwayat servis lengkap</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">💳</div>
                        <div class="feature-text">
                            <h4>Bayar Kapan Saja</h4>
                            <p>Sistem pembayaran fleksibel dan aman</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🔒</div>
                        <div class="feature-text">
                            <h4>Aman & Terpercaya</h4>
                            <p>Data terenkripsi dengan standar keamanan tinggi</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-footer">
                <div class="hero-contact">
                    <div class="contact-item">
                        <div class="contact-label">📞 Telepon</div>
                        <div class="contact-value">+62 123 4567</div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-label">📧 Email</div>
                        <div class="contact-value">info@pittelmoto.id</div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-label">🏢 Lokasi</div>
                        <div class="contact-value">Jakarta, Indonesia</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <div class="form-box">
                <div class="form-header">
                    <h2>Masuk</h2>
                    <p>Akses dashboard PitTel Moto Anda</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="masukkan@email.com"
                            required
                        >
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                        >
                        @error('password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" value="1">
                        <label for="remember">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn">Masuk Sekarang</button>
                </form>

                <div class="register-link">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
