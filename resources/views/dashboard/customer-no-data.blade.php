@extends('layouts.app')

@section('title', 'Dashboard - Pelanggan | PitTel Moto')

@section('content')
    <div class="card" style="text-align: center; padding: 3rem;">
        <h2 style="margin-bottom: 1rem;">⚠️ Data Pelanggan Tidak Ditemukan</h2>
        <p style="color: #666; margin-bottom: 2rem;">
            Akun Anda belum terhubung dengan data pelanggan. Silakan hubungi administrator untuk mengaktifkan akun Anda.
        </p>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-primary">Logout</button>
        </form>
    </div>
@endsection
