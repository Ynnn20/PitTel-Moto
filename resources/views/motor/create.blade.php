@extends('layouts.app')

@section('title', 'Tambah Data Motor | PitTel Moto')

@section('content')
    <div class="card-header">
        <h1>✚ Tambah Data Motor</h1>
    </div>

    <div class="card">
        <form action="{{ route('motor.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="pelanggan_id">Pemilik <span style="color: var(--primary-red);">*</span></label>
                    <select name="pelanggan_id" id="pelanggan_id" required>
                        <option value="">-- Pilih Pemilik --</option>
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
                    <label for="plat_nomor">Plat Nomor <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="plat_nomor" id="plat_nomor" required value="{{ old('plat_nomor') }}" placeholder="B 1234 XYZ" style="text-transform: uppercase;">
                    @error('plat_nomor')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" name="tahun" id="tahun" min="1900" max="2099" value="{{ old('tahun', date('Y')) }}" placeholder="2024">
                    @error('tahun')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="merk">Merk <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="merk" id="merk" required value="{{ old('merk') }}" placeholder="Honda, Yamaha, Suzuki...">
                    @error('merk')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="model">Model <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="model" id="model" required value="{{ old('model') }}" placeholder="Vario, Beat, Scoopy...">
                    @error('model')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="warna">Warna</label>
                    <input type="text" name="warna" id="warna" value="{{ old('warna') }}" placeholder="Hitam, Merah, Putih...">
                    @error('warna')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Simpan Motor</button>
                <a href="{{ route('motor.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
                    @enderror
                </div>

                <div>
                    <label for="model" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Model <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="model" id="model" required value="{{ old('model') }}" placeholder="Vario, Beat, Scoopy..." style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                    @error('model')
                        <span style="color: var(--primary-red); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="warna" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Warna</label>
                    <input type="text" name="warna" id="warna" value="{{ old('warna') }}" placeholder="Hitam, Merah, Putih..." style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                    @error('warna')
                        <span style="color: var(--primary-red); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('motor.index') }}" class="btn" style="background: #6c757d;">Batal</a>
            </div>
        </form>
    </div>
@endsection
