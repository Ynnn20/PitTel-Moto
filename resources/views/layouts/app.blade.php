<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PitTel Moto')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&family=Poppins:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Import dari style.css original */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-red: #D60A1E;
            --fire-red: #E61627;
            --dark-red: #A00815;
            --asphalt: #0F0F0F;
            --gear-gray: #1C1C1E;
            --steel: #2A2A2E;
            --yellow: #F2D544;
            --blue: #1877F2;
            --light-gray: #E8E8E8;
            --white: #FFFFFF;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9F9F9;
            color: var(--steel);
            line-height: 1.6;
        }

        h1, h2, h3 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            color: var(--asphalt);
        }

        h1 { font-size: 3rem; }
        h2 { font-size: 2rem; }
        h3 { font-size: 1.5rem; }
        h4, h5, h6 { font-family: 'Poppins', sans-serif; font-weight: 600; }

        /* Navbar */
        .navbar {
            background: var(--asphalt);
            border-bottom: 1px solid var(--gear-gray);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .navbar .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
        }

        .navbar .logo-icon {
            background: linear-gradient(135deg, var(--primary-red), var(--fire-red));
            padding: 0.75rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar .logo-text h3 {
            color: var(--white);
            font-size: 1.25rem;
            margin: 0;
        }

        .navbar .logo-text span {
            color: var(--yellow);
            font-size: 0.75rem;
            font-weight: 600;
        }

        .navbar nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .navbar nav a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar nav a:hover,
        .navbar nav a.active {
            color: var(--primary-red);
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-red), var(--fire-red));
            color: var(--white);
            box-shadow: 0 4px 15px rgba(214, 10, 30, 0.2);
        }

        .btn-primary:hover {
            box-shadow: 0 12px 30px rgba(214, 10, 30, 0.35);
            transform: translateY(-3px);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: var(--steel);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(42, 42, 46, 0.15);
        }

        .btn-secondary:hover {
            background: var(--asphalt);
            box-shadow: 0 8px 20px rgba(42, 42, 46, 0.25);
        }

        .btn-danger {
            background: var(--primary-red);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(214, 10, 30, 0.2);
        }

        .btn-danger:hover {
            box-shadow: 0 8px 20px rgba(214, 10, 30, 0.3);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        /* Main Content */
        main {
            margin-top: 80px;
            padding: 2rem;
            min-height: calc(100vh - 300px);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            margin-bottom: 2rem;
            border: 1px solid rgba(0,0,0,0.03);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid var(--light-gray);
        }

        .card-header h1 {
            margin: 0;
            color: var(--asphalt);
            font-size: 1.8rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border-left: 5px solid var(--primary-red);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .stat-card:hover {
            box-shadow: 0 8px 30px rgba(214, 10, 30, 0.15);
            transform: translateY(-5px);
        }

        .stat-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transform: translateY(-5px);
        }

        .stat-card .icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-red), var(--fire-red));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: white;
            font-size: 1.5rem;
        }

        .stat-card h4 {
            font-size: 2rem;
            color: var(--asphalt);
            margin-bottom: 0.5rem;
        }

        .stat-card p {
            color: var(--steel);
            opacity: 0.7;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        thead {
            background: linear-gradient(135deg, var(--asphalt), var(--gear-gray));
        }

        thead th {
            padding: 1.2rem 1rem;
            text-align: left;
            color: white;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        tbody td {
            padding: 1rem;
            border-bottom: 1px solid var(--light-gray);
            color: var(--steel);
            font-size: 0.95rem;
        }

        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            background: #f9f9f9;
            box-shadow: inset 0 0 10px rgba(214, 10, 30, 0.05);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Forms */
        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        label {
            font-weight: 600;
            color: var(--asphalt);
            font-size: 0.95rem;
            display: block;
            margin-bottom: 0.6rem;
            letter-spacing: 0.3px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 0.9rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: white;
            color: var(--asphalt);
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus,
        input[type="number"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary-red);
            box-shadow: 0 0 0 3px rgba(214, 10, 30, 0.1);
            background: white;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
            font-family: 'Inter', sans-serif;
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="number"]::placeholder {
            color: #999;
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border-left: 5px solid;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border-left-color: #28a745;
        }

        .alert-error {
            background: #ffebee;
            color: #c62828;
            border-left-color: #dc3545;
        }

        /* Form Groups */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .form-group.has-error input,
        .form-group.has-error select,
        .form-group.has-error textarea {
            border-color: #dc3545;
        }

        .form-error {
            color: #dc3545;
            font-size: 0.85rem;
            font-weight: 500;
            animation: slideIn 0.2s ease;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-grid.full {
            grid-column: 1 / -1;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--light-gray);
        }

        /* Footer */
        footer {
            background: var(--asphalt);
            color: rgba(255, 255, 255, 0.7);
            padding: 3rem 2rem 2rem;
            margin-top: 4rem;
            border-top: 1px solid var(--gear-gray);
        }

        footer .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 2rem;
        }

        footer .footer-section h4 {
            color: var(--white);
            font-size: 1.1rem;
            margin-bottom: 1rem;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }

        footer .footer-section p {
            font-size: 0.95rem;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.65);
        }

        footer .footer-contact {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        footer .footer-contact p {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 0.95rem;
        }

        footer .footer-contact a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer .footer-contact a:hover {
            color: var(--yellow);
        }

        footer .footer-copyright {
            text-align: center;
            border-top: 1px solid var(--gear-gray);
            padding-top: 2rem;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            h1 { font-size: 2rem; }
            h2 { font-size: 1.5rem; }

            .navbar .container {
                flex-direction: column;
                gap: 1rem;
            }

            .navbar nav ul {
                flex-wrap: wrap;
                gap: 1rem;
                justify-content: center;
            }

            main {
                margin-top: 200px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('dashboard') }}" class="logo">
                <div class="logo-icon">
                    <span style="font-size: 1.5rem;">⚙️</span>
                </div>
                <div class="logo-text">
                    <h3>PitTel Moto</h3>
                    <span>Fast & Trusted</span>
                </div>
            </a>

            <nav>
                <ul>
                    <li><a href="{{ route('dashboard') }}" class="@if(request()->is('dashboard*')) active @endif">Dashboard</a></li>

                    @if(Auth::user()->isAdmin())
                        <!-- Admin Menu -->
                        <li><a href="{{ route('servis.index') }}" class="@if(request()->is('servis*')) active @endif">Servis</a></li>
                        <li><a href="{{ route('motor.index') }}" class="@if(request()->is('motor*')) active @endif">Motor</a></li>
                        <li><a href="{{ route('pelanggan.index') }}" class="@if(request()->is('pelanggan*')) active @endif">Pelanggan</a></li>
                        <li><a href="{{ route('mekanik.index') }}" class="@if(request()->is('mekanik*')) active @endif">Mekanik</a></li>
                        <li><a href="{{ route('sparepart.index') }}" class="@if(request()->is('sparepart*')) active @endif">Spareparts</a></li>
                    @endif

                    <li style="margin-left: auto; border-left: 1px solid rgba(255,255,255,0.2); padding-left: 1.5rem;">
                        <span style="color: rgba(255,255,255,0.8); margin-right: 1rem;">{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <!-- About Section -->
            <div class="footer-section">
                <h4>🏁 PitTel Moto</h4>
                <p>Layanan servis motor racing-grade dengan mekanik profesional dan teknologi modern.</p>
            </div>

            <!-- Contact Section -->
            <div class="footer-section">
                <h4>📞 Kontak</h4>
                <div class="footer-contact">
                    <p>📍 Jl. Mekanik Raya No. 123, Jakarta</p>
                    <p><a href="tel:+628123456789">📞 +62 812-3456-7890</a></p>
                    <p><a href="mailto:info@pittelmoto.com">📧 info@pittelmoto.com</a></p>
                </div>
            </div>

            <!-- Operating Hours Section -->
            <div class="footer-section">
                <h4>⏰ Jam Operasional</h4>
                <div class="footer-contact">
                    <p>Senin - Jumat: 08:00 - 18:00</p>
                    <p>Sabtu: 08:00 - 16:00</p>
                    <p>Minggu: Tutup</p>
                </div>
            </div>
        </div>

        <div class="footer-copyright">
            &copy; 2025 PitTel Moto. All rights reserved.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
