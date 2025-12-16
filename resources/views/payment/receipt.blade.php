@extends('layouts.app')

@section('title', 'Bukti Pembayaran | PitTel Moto')

@section('content')
    <div style="max-width: 600px; margin: 0 auto;">
        <div class="card" style="border: 2px solid var(--primary-red); padding: 2rem;">
            <!-- Header -->
            <div style="text-align: center; margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 2px solid #f0f0f0;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">✅</div>
                <h2 style="color: var(--primary-red); margin: 0.5rem 0;">Pembayaran Berhasil</h2>
                <p style="color: #666; margin: 0;">Terima kasih atas pembayaran Anda</p>
            </div>

            <!-- Payment Details -->
            <div style="margin-bottom: 2rem;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <p style="color: #999; margin: 0 0 0.5rem 0; font-size: 0.9rem;">Nomor Servis</p>
                        <p style="font-weight: 600; margin: 0; font-size: 1.1rem;">SRV-{{ str_pad($servis->id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <p style="color: #999; margin: 0 0 0.5rem 0; font-size: 0.9rem;">Tanggal Pembayaran</p>
                        <p style="font-weight: 600; margin: 0; font-size: 1.1rem;">{{ $payment->payment_date->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Service Details -->
            <div style="background: #f9f9f9; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                <h4 style="margin: 0 0 1rem 0; color: var(--primary-red);">Detail Servis</h4>
                <div style="display: grid; gap: 0.8rem;">
                    <div>
                        <p style="color: #999; margin: 0 0 0.3rem 0; font-size: 0.9rem;">Motor</p>
                        <p style="font-weight: 600; margin: 0;">{{ $servis->motor->plat_nomor }} ({{ $servis->motor->merk }} {{ $servis->motor->model }})</p>
                    </div>
                    <div>
                        <p style="color: #999; margin: 0 0 0.3rem 0; font-size: 0.9rem;">Keluhan</p>
                        <p style="font-weight: 600; margin: 0;">{{ $servis->keluhan }}</p>
                    </div>
                    <div>
                        <p style="color: #999; margin: 0 0 0.3rem 0; font-size: 0.9rem;">Mekanik</p>
                        <p style="font-weight: 600; margin: 0;">{{ $servis->mekanik->nama }}</p>
                    </div>
                    <div>
                        <p style="color: #999; margin: 0 0 0.3rem 0; font-size: 0.9rem;">Tanggal Servis</p>
                        <p style="font-weight: 600; margin: 0;">{{ \Carbon\Carbon::parse($servis->tanggal_servis)->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div style="background: #fef5f5; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border: 1px solid #f0e0e0;">
                <h4 style="margin: 0 0 1rem 0; color: var(--primary-red);">Informasi Pembayaran</h4>
                <div style="display: grid; gap: 0.8rem;">
                    <div style="display: flex; justify-content: space-between;">
                        <span>Metode Pembayaran:</span>
                        <strong>{{ ucfirst($payment->method) }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Status Pembayaran:</span>
                        <strong style="color: #155724;">✓ {{ ucfirst($payment->status) }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding-top: 0.8rem; border-top: 1px solid #f0e0e0; font-size: 1.1rem;">
                        <span>Jumlah Pembayaran:</span>
                        <strong style="color: var(--primary-red);">Rp {{ number_format($payment->amount, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>

            <!-- Payer Information -->
            <div style="background: #f9f9f9; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                <h4 style="margin: 0 0 1rem 0;">Penerima Pembayaran</h4>
                <div style="display: grid; gap: 0.5rem;">
                    <p style="margin: 0;"><strong>{{ $servis->pelanggan->nama }}</strong></p>
                    <p style="margin: 0; color: #666;">{{ $servis->pelanggan->telepon }}</p>
                    <p style="margin: 0; color: #666;">{{ $servis->pelanggan->email ?? '-' }}</p>
                </div>
            </div>

            <!-- Footer -->
            <div style="text-align: center; padding-top: 2rem; border-top: 1px solid #f0f0f0;">
                <p style="color: #999; margin: 0 0 1rem 0;">Bukti pembayaran ini berlaku sebagai tanda terima</p>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">← Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
@endsection
