@extends('layouts.app')

@section('title', 'Tambah Data Sparepart | PitTel Moto')

@section('content')
    <div class="card-header">
        <h1>✚ Tambah Data Sparepart</h1>
    </div>

    <div class="card">
        <form action="{{ route('sparepart.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="nama">Nama Sparepart <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="nama" id="nama" required value="{{ old('nama') }}" placeholder="Oli, Kampas Rem...">
                    @error('nama')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kode">Kode</label>
                    <input type="text" name="kode" id="kode" value="{{ old('kode') }}" placeholder="SP001" style="text-transform: uppercase;">
                    @error('kode')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stok">Stok <span style="color: var(--primary-red);">*</span></label>
                    <input type="number" name="stok" id="stok" required min="0" value="{{ old('stok', 0) }}">
                    @error('stok')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="minimal_stok">Minimal Stok <span style="color: var(--primary-red);">*</span></label>
                    <input type="number" name="minimal_stok" id="minimal_stok" required min="0" value="{{ old('minimal_stok', 5) }}">
                    @error('minimal_stok')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga">Harga (Rp) <span style="color: var(--primary-red);">*</span></label>
                    <input type="number" name="harga" id="harga" required min="0" step="1000" value="{{ old('harga', 0) }}">
                    @error('harga')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="satuan">Satuan <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="satuan" id="satuan" required value="{{ old('satuan', 'pcs') }}" placeholder="pcs, liter, set...">
                    @error('satuan')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Simpan Sparepart</button>
                <a href="{{ route('sparepart.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
