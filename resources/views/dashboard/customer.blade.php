@extends('layouts.app')

@section('title', 'Dashboard - Pelanggan | PitTel Moto')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Dashboard Pelanggan</h1>
        <p style="color: #666;">Selamat datang, <strong>{{ Auth::user()->name }}</strong>! 👋</p>
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
            <div class="icon">💰</div>
            <h4>Rp {{ number_format($stats['total_pembayaran'] ?? 0, 0, ',', '.') }}</h4>
            <p>Total Biaya Servis</p>
        </div>

        <div class="stat-card">
            <div class="icon">✔️</div>
            <h4>Rp {{ number_format($stats['pembayaran_lunas'] ?? 0, 0, ',', '.') }}</h4>
            <p>Pembayaran Lunas</p>
        </div>
    </div>

    <!-- Service History Section -->
    <div style="margin-top: 3rem;">
        <h2 style="margin-bottom: 2rem;">📋 Riwayat Servis Anda</h2>

        @if($servisList->count() > 0)
            <div class="card">
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f9f9f9; border-bottom: 2px solid #e0e0e0;">
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Tanggal</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Motor (Plat)</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Keluhan</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Mekanik</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Status</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Biaya</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #0F0F0F;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($servisList as $servis)
                                <tr style="border-bottom: 1px solid #e8e8e8; transition: background-color 0.2s;">
                                    <td style="padding: 1rem;">{{ \Carbon\Carbon::parse($servis->tanggal_servis)->format('d/m/Y') }}</td>
                                    <td style="padding: 1rem;"><strong>{{ $servis->motor->plat_nomor ?? '-' }}</strong></td>
                                    <td style="padding: 1rem;">{{ Str::limit($servis->keluhan ?? '-', 30, '...') }}</td>
                                    <td style="padding: 1rem;">{{ $servis->mekanik->nama ?? '-' }}</td>
                                    <td style="padding: 1rem;">
                                        <span style="padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;
                                            @if($servis->status == 'selesai') background-color: #d4edda; color: #155724;
                                            @elseif($servis->status == 'proses') background-color: #fff3cd; color: #856404;
                                            @else background-color: #f8d7da; color: #721c24; @endif">
                                            {{ ucfirst($servis->status) }}
                                        </span>
                                    </td>
                                    <td style="padding: 1rem; font-weight: 600;">Rp {{ number_format($servis->biaya ?? 0, 0, ',', '.') }}</td>
                                    <td style="padding: 1rem;">
                                        @if($servis->status == 'selesai')
                                            @if(!$servis->paid)
                                                <button onclick="openPaymentModal({{ $servis->id }}, '{{ $servis->motor->plat_nomor }}', {{ $servis->biaya }})"
                                                    class="btn btn-primary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">💳 Bayar</button>
                                            @else
                                                <span style="color: #155724; font-weight: 600;">✓ Lunas</span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="card" style="text-align: center; padding: 3rem;">
                <p style="font-size: 1.1rem; color: #999;">Anda belum memiliki riwayat servis</p>
            </div>
        @endif
    </div>

    <!-- Payment Modal -->
    <div id="paymentModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div class="card" style="width: 90%; max-width: 500px; position: relative;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; border-bottom: 1px solid #f0f0f0;">
                <h3 style="margin: 0;">💳 Lakukan Pembayaran</h3>
                <button onclick="closePaymentModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">✕</button>
            </div>

            <div style="padding: 1.5rem;">
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Motor (Plat)</label>
                    <p id="modalPlat" style="margin: 0; padding: 0.75rem; background: #f9f9f9; border-radius: 8px; font-weight: 600;"></p>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Jumlah Pembayaran</label>
                    <p id="modalBiaya" style="margin: 0; padding: 0.75rem; background: #d4edda; border-radius: 8px; font-weight: 600; color: #155724; font-size: 1.2rem;"></p>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Metode Pembayaran</label>
                    <select id="paymentMethod" style="width: 100%; padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem;">
                        <option value="">-- Pilih Metode --</option>
                        <option value="tunai">Tunai</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="kartu">Kartu Kredit</option>
                    </select>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="button" onclick="processPayment()" class="btn btn-primary" style="flex: 1;">Konfirmasi Pembayaran</button>
                    <button type="button" onclick="closePaymentModal()" class="btn btn-secondary" style="flex: 1;">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentServisId = null;

        function openPaymentModal(servisId, plat, biaya) {
            currentServisId = servisId;
            document.getElementById('modalPlat').textContent = plat;
            document.getElementById('modalBiaya').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(biaya);
            document.getElementById('paymentMethod').value = '';
            document.getElementById('paymentModal').style.display = 'flex';
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').style.display = 'none';
            currentServisId = null;
        }

        function processPayment() {
            const method = document.getElementById('paymentMethod').value;

            if (!method) {
                alert('Pilih metode pembayaran terlebih dahulu');
                return;
            }

            if (confirm('Konfirmasi pembayaran via ' + method + '?')) {
                // Submit form to process payment
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/payment/process';

                const token = document.createElement('input');
                token.type = 'hidden';
                token.name = '_token';
                token.value = document.querySelector('meta[name="csrf-token"]').content;

                const servisInput = document.createElement('input');
                servisInput.type = 'hidden';
                servisInput.name = 'servis_id';
                servisInput.value = currentServisId;

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = 'payment_method';
                methodInput.value = method;

                form.appendChild(token);
                form.appendChild(servisInput);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Close modal when clicking outside
        document.getElementById('paymentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePaymentModal();
            }
        });
    </script>

    <!-- Quick Links -->
    <div style="margin-top: 3rem;">
        <h2 style="margin-bottom: 2rem;">ℹ️ Informasi Akun</h2>

        <div class="card">
            <div style="padding: 2rem;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                    <div>
                        <h4 style="color: var(--primary-red); margin-bottom: 0.5rem;">Nama Pemilik</h4>
                        <p style="font-size: 1.1rem; margin: 0;">{{ $pelanggan->nama }}</p>
                    </div>
                    <div>
                        <h4 style="color: var(--primary-red); margin-bottom: 0.5rem;">Nomor Telepon</h4>
                        <p style="font-size: 1.1rem; margin: 0;">{{ $pelanggan->telepon }}</p>
                    </div>
                    <div>
                        <h4 style="color: var(--primary-red); margin-bottom: 0.5rem;">Email</h4>
                        <p style="font-size: 1.1rem; margin: 0;">{{ $pelanggan->email ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
