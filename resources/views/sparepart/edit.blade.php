@extends('layouts.app')

@section('title', 'Edit Data Sparepart | PitTel Moto')

@section('content')
    <div class="card-header">
        <h1>✏️ Edit Data Sparepart</h1>
    </div>

    <div class="card">
        <form action="{{ route('sparepart.update', $sparepart->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label for="nama">Nama Sparepart <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="nama" id="nama" required value="{{ old('nama', $sparepart->nama) }}" placeholder="Oli, Kampas Rem...">
                    @error('nama')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kode">Kode</label>
                    <input type="text" name="kode" id="kode" value="{{ old('kode', $sparepart->kode) }}" placeholder="SP001" style="text-transform: uppercase;">
                    @error('kode')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stok">Stok <span style="color: var(--primary-red);">*</span></label>
                    <input type="number" name="stok" id="stok" required min="0" value="{{ old('stok', $sparepart->stok) }}">
                    @error('stok')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="minimal_stok">Minimal Stok <span style="color: var(--primary-red);">*</span></label>
                    <input type="number" name="minimal_stok" id="minimal_stok" required min="0" value="{{ old('minimal_stok', $sparepart->minimal_stok) }}">
                    @error('minimal_stok')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga">Harga (Rp) <span style="color: var(--primary-red);">*</span></label>
                    <input type="number" name="harga" id="harga" required min="0" step="1000" value="{{ old('harga', $sparepart->harga) }}">
                    @error('harga')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="satuan">Satuan <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" name="satuan" id="satuan" required value="{{ old('satuan', $sparepart->satuan) }}" placeholder="pcs, liter, set...">
                    @error('satuan')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Update Sparepart</button>
                <a href="{{ route('sparepart.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
