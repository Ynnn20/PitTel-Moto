@extends('layouts.app')

@section('title', 'Tambah Data Servis | PitTel Moto')

@section('content')
    <div class="card-header">
        <h1>✚ Tambah Data Servis</h1>
    </div>

    <div class="card">
        <form action="{{ route('servis.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="pelanggan_id">Pelanggan <span style="color: var(--primary-red);">*</span></label>
                    <select name="pelanggan_id" id="pelanggan_id" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}" {{ old('pelanggan_id') == $pelanggan->id ? 'selected' : '' }}>
                                {{ $pelanggan->nama }} - {{ $pelanggan->telepon }}
                            </option>
                        @endforeach
                    </select>
                    @error('pelanggan_id')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="motor_id">Motor <span style="color: var(--primary-red);">*</span></label>
                    <select name="motor_id" id="motor_id" required>
                        <option value="">-- Pilih Motor --</option>
                        @foreach($motors as $motor)
                            <option value="{{ $motor->id }}" {{ old('motor_id') == $motor->id ? 'selected' : '' }}>
                                {{ $motor->plat_nomor }} - {{ $motor->merk }} {{ $motor->model }}
                            </option>
                        @endforeach
                    </select>
                    @error('motor_id')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mekanik_id">Mekanik</label>
                    <select name="mekanik_id" id="mekanik_id">
                        <option value="">-- Pilih Mekanik --</option>
                        @foreach($mekaniks as $mekanik)
                            <option value="{{ $mekanik->id }}" {{ old('mekanik_id') == $mekanik->id ? 'selected' : '' }}>
                                {{ $mekanik->nama }} - {{ $mekanik->spesialisasi }}
                            </option>
                        @endforeach
                    </select>
                    @error('mekanik_id')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_servis">Tanggal Servis <span style="color: var(--primary-red);">*</span></label>
                    <input type="date" name="tanggal_servis" id="tanggal_servis" required value="{{ old('tanggal_servis', date('Y-m-d')) }}">
                    @error('tanggal_servis')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="keluhan">Keluhan <span style="color: var(--primary-red);">*</span></label>
                    <textarea name="keluhan" id="keluhan" required placeholder="Deskripsikan keluhan motor...">{{ old('keluhan') }}</textarea>
                    @error('keluhan')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="tindakan">Tindakan</label>
                    <textarea name="tindakan" id="tindakan" placeholder="Deskripsikan tindakan yang dilakukan...">{{ old('tindakan') }}</textarea>
                    @error('tindakan')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="biaya">Biaya (Rp)</label>
                    <input type="number" name="biaya" id="biaya" min="0" step="1000" value="{{ old('biaya', 0) }}" placeholder="0">
                    @error('biaya')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status <span style="color: var(--primary-red);">*</span></label>
                    <select name="status" id="status" required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="proses" {{ old('status', 'proses') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Simpan Servis</button>
                <a href="{{ route('servis.index') }}" class="btn btn-secondary">Batal</a>
