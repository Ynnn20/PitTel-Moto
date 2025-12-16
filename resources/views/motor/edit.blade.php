@extends('layouts.app')

@section('title', 'Edit Data Motor | PitTel Moto')

@section('content')
    <div class="card-header">
        <h1>✏️ Edit Data Motor</h1>
    </div>

    <div class="card">
        <form action="{{ route('motor.update', $motor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="pelanggan_id">Pemilik <span style="color: var(--primary-red);">*</span></label>
                    <select name="pelanggan_id" id="pelanggan_id" required>
                        <option value="">-- Pilih Pemilik --</option>
                        @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}" {{ (old('pelanggan_id', $motor->pelanggan_id) == $pelanggan->id) ? 'selected' : '' }}>
                                {{ $pelanggan->nama }} - {{ $pelanggan->telepon }}
                            </option>
                        @endforeach
                    </select>
                    @error('pelanggan_id')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="plat_nomor">Plat Nomor <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="plat_nomor" id="plat_nomor" required value="{{ old('plat_nomor', $motor->plat_nomor) }}" placeholder="B 1234 XYZ" style="text-transform: uppercase;">
                    @error('plat_nomor')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" name="tahun" id="tahun" min="1900" max="2099" value="{{ old('tahun', $motor->tahun) }}" placeholder="2024">
                    @error('tahun')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="merk">Merk <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="merk" id="merk" required value="{{ old('merk', $motor->merk) }}" placeholder="Honda, Yamaha, Suzuki...">
                    @error('merk')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="model">Model <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="model" id="model" required value="{{ old('model', $motor->model) }}" placeholder="Vario, Beat, Scoopy...">
                    @error('model')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="warna">Warna</label>
                    <input type="text" name="warna" id="warna" value="{{ old('warna', $motor->warna) }}" placeholder="Hitam, Merah, Putih...">
                    @error('warna')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Update Motor</button>
                <a href="{{ route('motor.index') }}" class="btn btn-secondary">Batal</a>
