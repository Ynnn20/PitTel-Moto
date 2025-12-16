@extends('layouts.app')

@section('title', 'Tambah Data Mekanik | PitTel Moto')

@section('content')
    <div class="card-header">
        <h1>✚ Tambah Data Mekanik</h1>
    </div>

    <div class="card">
        <form action="{{ route('mekanik.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="nama">Nama Mekanik <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="nama" id="nama" required value="{{ old('nama') }}" placeholder="Masukkan nama mekanik">
                    @error('nama')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx">
                    @error('telepon')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="spesialisasi">Spesialisasi</label>
                    <input type="text" name="spesialisasi" id="spesialisasi" value="{{ old('spesialisasi') }}" placeholder="Mesin, Kelistrikan, Body...">
                    @error('spesialisasi')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="aktif">Status <span style="color: var(--primary-red);">*</span></label>
                    <select name="aktif" id="aktif" required>
                        <option value="1" {{ old('aktif', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('aktif') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('aktif')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Simpan Mekanik</button>
                <a href="{{ route('mekanik.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
