@extends('layouts.app')

@section('title', 'Dashboard | PitTel Moto')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Dashboard</h1>
        <p style="color: #666;">Selamat datang, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>! 👋</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="icon">📋</div>
            <h4>{{ $stats['total_servis'] ?? 0 }}</h4>
            <p>Total Servis</p>
        </div>

        <div class="stat-card">
            <div class="icon">✅</div>
            <h4>{{ $stats['servis_selesai'] ?? 0 }}</h4>
            <p>Servis Selesai</p>
        </div>

        <div class="stat-card">
            <div class="icon">🏍️</div>
            <h4>{{ $stats['total_motor'] ?? 0 }}</h4>
            <p>Total Motor</p>
        </div>

        <div class="stat-card">
            <div class="icon">👥</div>
            <h4>{{ $stats['total_pelanggan'] ?? 0 }}</h4>
            <p>Total Pelanggan</p>
        </div>
    </div>

    <!-- Tables Section -->
    <div style="margin-top: 3rem;">
        <h2 style="margin-bottom: 2rem;">📊 Data Terbaru</h2>

        <!-- Recent Servis Table -->
        <div class="card" style="margin-bottom: 2rem;">
            <div style="padding: 1.5rem; border-bottom: 1px solid #f0f0f0;">
                <h3 style="margin: 0; font-size: 1.3rem;">📋 Servis Terbaru</h3>
            </div>
            @if($recentServis->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f9f9f9; border-bottom: 2px solid #e0e0e0;">
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Tanggal</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Pelanggan</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Motor</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Mekanik</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Status</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentServis as $servis)
                                <tr style="border-bottom: 1px solid #e8e8e8; transition: background-color 0.2s;">
                                    <td style="padding: 1rem;">{{ \Carbon\Carbon::parse($servis->tanggal_servis)->format('d/m/Y') }}</td>
                                    <td style="padding: 1rem;">{{ $servis->pelanggan->nama ?? '-' }}</td>
                                    <td style="padding: 1rem;">{{ $servis->motor->plat_nomor ?? '-' }}</td>
                                    <td style="padding: 1rem;">{{ $servis->mekanik->nama ?? '-' }}</td>
                                    <td style="padding: 1rem;">
                                        <span style="padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;
                                            @if($servis->status == 'selesai') background-color: #d4edda; color: #155724;
                                            @elseif($servis->status == 'proses') background-color: #fff3cd; color: #856404;
                                            @else background-color: #f8d7da; color: #721c24; @endif">
                                            {{ ucfirst($servis->status) }}
                                        </span>
                                    </td>
                                    <td style="padding: 1rem;">Rp {{ number_format($servis->biaya ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="padding: 1rem; text-align: right; border-top: 1px solid #f0f0f0;">
                    <a href="{{ route('servis.index') }}" style="color: var(--primary-red); text-decoration: none; font-weight: 600;">Lihat Semua →</a>
                </div>
            @else
                <div style="padding: 2rem; text-align: center; color: #999;">
                    Tidak ada data servis
                </div>
            @endif
        </div>

        <!-- Recent Motor Table -->
        <div class="card" style="margin-bottom: 2rem;">
            <div style="padding: 1.5rem; border-bottom: 1px solid #f0f0f0;">
                <h3 style="margin: 0; font-size: 1.3rem;">🏍️ Motor Terbaru</h3>
            </div>
            @if($recentMotor->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f9f9f9; border-bottom: 2px solid #e0e0e0;">
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Plat Nomor</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Pemilik</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Merk</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Model</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Tahun</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Warna</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentMotor as $motor)
                                <tr style="border-bottom: 1px solid #e8e8e8; transition: background-color 0.2s;">
                                    <td style="padding: 1rem;"><strong>{{ $motor->plat_nomor }}</strong></td>
                                    <td style="padding: 1rem;">{{ $motor->pelanggan->nama ?? '-' }}</td>
                                    <td style="padding: 1rem;">{{ $motor->merk }}</td>
                                    <td style="padding: 1rem;">{{ $motor->model }}</td>
                                    <td style="padding: 1rem;">{{ $motor->tahun ?? '-' }}</td>
                                    <td style="padding: 1rem;">{{ $motor->warna ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="padding: 1rem; text-align: right; border-top: 1px solid #f0f0f0;">
                    <a href="{{ route('motor.index') }}" style="color: var(--primary-red); text-decoration: none; font-weight: 600;">Lihat Semua →</a>
                </div>
            @else
                <div style="padding: 2rem; text-align: center; color: #999;">
                    Tidak ada data motor
                </div>
            @endif
        </div>

        <!-- Recent Pelanggan Table -->
        <div class="card" style="margin-bottom: 2rem;">
            <div style="padding: 1.5rem; border-bottom: 1px solid #f0f0f0;">
                <h3 style="margin: 0; font-size: 1.3rem;">👥 Pelanggan Terbaru</h3>
            </div>
            @if($recentPelanggan->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f9f9f9; border-bottom: 2px solid #e0e0e0;">
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Nama</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Telepon</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Email</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPelanggan as $pelanggan)
                                <tr style="border-bottom: 1px solid #e8e8e8; transition: background-color 0.2s;">
                                    <td style="padding: 1rem;"><strong>{{ $pelanggan->nama }}</strong></td>
                                    <td style="padding: 1rem;">{{ $pelanggan->telepon }}</td>
                                    <td style="padding: 1rem;">{{ $pelanggan->email ?? '-' }}</td>
                                    <td style="padding: 1rem;">{{ Str::limit($pelanggan->alamat, 30, '...') ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="padding: 1rem; text-align: right; border-top: 1px solid #f0f0f0;">
                    <a href="{{ route('pelanggan.index') }}" style="color: var(--primary-red); text-decoration: none; font-weight: 600;">Lihat Semua →</a>
                </div>
            @else
                <div style="padding: 2rem; text-align: center; color: #999;">
                    Tidak ada data pelanggan
                </div>
            @endif
        </div>

        <!-- Low Stock Spareparts Warning -->
        @if($lowStockSpareparts->count() > 0)
            <div class="card" style="margin-bottom: 2rem; border-left: 4px solid #D60A1E;">
                <div style="padding: 1.5rem; border-bottom: 1px solid #f0f0f0;">
                    <h3 style="margin: 0; font-size: 1.3rem;">⚠️ Spareparts Stok Rendah</h3>
                </div>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f9f9f9; border-bottom: 2px solid #e0e0e0;">
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Nama</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Stok Saat Ini</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Minimal</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lowStockSpareparts as $sparepart)
                                <tr style="border-bottom: 1px solid #e8e8e8; background-color: #fef5f5;">
                                    <td style="padding: 1rem;"><strong>{{ $sparepart->nama }}</strong></td>
                                    <td style="padding: 1rem;">
                                        <span style="color: #D60A1E; font-weight: 600;">{{ $sparepart->stok }} {{ $sparepart->satuan }}</span>
                                    </td>
                                    <td style="padding: 1rem;">{{ $sparepart->minimal_stok }} {{ $sparepart->satuan }}</td>
                                    <td style="padding: 1rem;">Rp {{ number_format($sparepart->harga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="padding: 1rem; text-align: right; border-top: 1px solid #f0f0f0;">
                    <a href="{{ route('sparepart.index') }}" style="color: var(--primary-red); text-decoration: none; font-weight: 600;">Kelola Spareparts →</a>
                </div>
            </div>
        @endif
    </div>

    <!-- Features Section -->
    <div style="margin-top: 3rem;">
        <h2 style="margin-bottom: 2rem;">Kelola Sistem</h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            <!-- Servis Card -->
            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); text-align: center; transition: all 0.3s;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📋</div>
                <h3 style="color: #0F0F0F; margin-bottom: 1rem;">Servis</h3>
                <p style="color: #666; margin-bottom: 1.5rem;">Kelola data servis motor, status, dan biaya layanan</p>
                <a href="{{ route('servis.index') }}" class="btn btn-primary">Lihat Servis</a>
            </div>

            <!-- Motor Card -->
            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); text-align: center; transition: all 0.3s;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🏍️</div>
                <h3 style="color: #0F0F0F; margin-bottom: 1rem;">Motor</h3>
                <p style="color: #666; margin-bottom: 1.5rem;">Kelola data motor, spesifikasi, dan pemilik</p>
                <a href="{{ route('motor.index') }}" class="btn btn-primary">Lihat Motor</a>
            </div>

            <!-- Pelanggan Card -->
            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); text-align: center; transition: all 0.3s;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">👥</div>
                <h3 style="color: #0F0F0F; margin-bottom: 1rem;">Pelanggan</h3>
                <p style="color: #666; margin-bottom: 1.5rem;">Kelola data pelanggan dan riwayat servis</p>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-primary">Lihat Pelanggan</a>
            </div>

            <!-- Mekanik Card -->
            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); text-align: center; transition: all 0.3s;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🔧</div>
                <h3 style="color: #0F0F0F; margin-bottom: 1rem;">Mekanik</h3>
                <p style="color: #666; margin-bottom: 1.5rem;">Kelola data mekanik dan keahlian mereka</p>
                <a href="{{ route('mekanik.index') }}" class="btn btn-primary">Lihat Mekanik</a>
            </div>

            <!-- Spareparts Card -->
            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); text-align: center; transition: all 0.3s;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">⚙️</div>
                <h3 style="color: #0F0F0F; margin-bottom: 1rem;">Spareparts</h3>
                <p style="color: #666; margin-bottom: 1.5rem;">Kelola inventori spareparts dan stok</p>
                <a href="{{ route('sparepart.index') }}" class="btn btn-primary">Lihat Spareparts</a>
            </div>

            <!-- Laporan Card -->
            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); text-align: center; transition: all 0.3s;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📊</div>
                <h3 style="color: #0F0F0F; margin-bottom: 1rem;">Laporan</h3>
                <p style="color: #666; margin-bottom: 1.5rem;">Lihat laporan statistik dan analisis servis</p>
                <a href="#" class="btn btn-primary">Lihat Laporan</a>
            </div>
        </div>
    </div>

    <!-- Getting Started Section -->
    <div class="card" style="background: linear-gradient(135deg, #0F0F0F, #1C1C1E); color: white; margin-top: 2rem;">
        <h2 style="color: white; margin-bottom: 1rem;">🚀 Mulai Sekarang</h2>
        <p style="margin-bottom: 1.5rem; color: rgba(255,255,255,0.8);">Platform ini membantu Anda mengelola semua aspek servis motor dengan mudah dan efisien.</p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
            <div>
                <h4 style="color: #F2D544; margin-bottom: 0.5rem;">1. Tambah Data Pelanggan</h4>
                <p style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Mulai dengan menambahkan data pelanggan baru ke sistem</p>
            </div>
            <div>
                <h4 style="color: #F2D544; margin-bottom: 0.5rem;">2. Registrasi Motor</h4>
                <p style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Daftarkan motor-motor yang akan diservice</p>
            </div>
            <div>
                <h4 style="color: #F2D544; margin-bottom: 0.5rem;">3. Buat Order Servis</h4>
                <p style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">Buat order servis dan kelola progresnya</p>
            </div>
        </div>
    </div>
@endsection
