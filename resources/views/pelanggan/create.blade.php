@extends('layouts.app')

@section('title', 'Tambah Data Pelanggan | PitTel Moto')

@section('content')
    <div class="card-header">
        <h1>✚ Tambah Data Pelanggan</h1>
    </div>

    <div class="card">
        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="nama">Nama Lengkap <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="nama" id="nama" required value="{{ old('nama') }}" placeholder="Masukkan nama lengkap">
                    @error('nama')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telepon">Telepon <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="telepon" id="telepon" required value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx">
                    @error('telepon')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="email@example.com">
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Simpan Pelanggan</button>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
