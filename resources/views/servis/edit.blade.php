@extends('layouts.app')

@section('title', 'Edit Data Servis | PitTel Moto')

@section('content')
    <div class="card-header">
        <h1>✏️ Edit Data Servis</h1>
    </div>

    <div class="card">
        <form action="{{ route('servis.update', $servis->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label for="pelanggan_id">Pelanggan <span style="color: var(--primary-red);">*</span></label>
                    <select name="pelanggan_id" id="pelanggan_id" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}" {{ (old('pelanggan_id', $servis->pelanggan_id) == $pelanggan->id) ? 'selected' : '' }}>
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
                            <option value="{{ $motor->id }}" {{ (old('motor_id', $servis->motor_id) == $motor->id) ? 'selected' : '' }}>
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
                            <option value="{{ $mekanik->id }}" {{ (old('mekanik_id', $servis->mekanik_id) == $mekanik->id) ? 'selected' : '' }}>
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
                    <input type="date" name="tanggal_servis" id="tanggal_servis" required value="{{ old('tanggal_servis', $servis->tanggal_servis?->format('Y-m-d')) }}">
                    @error('tanggal_servis')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="keluhan">Keluhan <span style="color: var(--primary-red);">*</span></label>
                    <textarea name="keluhan" id="keluhan" required placeholder="Deskripsikan keluhan motor...">{{ old('keluhan', $servis->keluhan) }}</textarea>
                    @error('keluhan')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="tindakan">Tindakan</label>
                    <textarea name="tindakan" id="tindakan" placeholder="Deskripsikan tindakan yang dilakukan...">{{ old('tindakan', $servis->tindakan) }}</textarea>
                    @error('tindakan')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="biaya">Biaya (Rp)</label>
                    <input type="number" name="biaya" id="biaya" min="0" step="1000" value="{{ old('biaya', $servis->biaya) }}" placeholder="0">
                    @error('biaya')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status <span style="color: var(--primary-red);">*</span></label>
                    <select name="status" id="status" required>
                        <option value="pending" {{ old('status', $servis->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="proses" {{ old('status', $servis->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ old('status', $servis->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Update Servis</button>
                <a href="{{ route('servis.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
                            <option value="{{ $mekanik->id }}" {{ (old('mekanik_id', $servis->mekanik_id) == $mekanik->id) ? 'selected' : '' }}>
                                {{ $mekanik->nama }} - {{ $mekanik->spesialisasi }}
                            </option>
                        @endforeach
                    </select>
                    @error('mekanik_id')
                        <span style="color: var(--primary-red); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_servis" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Tanggal Servis <span style="color: var(--primary-red);">*</span></label>
                    <input type="date" name="tanggal_servis" id="tanggal_servis" required value="{{ old('tanggal_servis', $servis->tanggal_servis?->format('Y-m-d')) }}" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                    @error('tanggal_servis')
                        <span style="color: var(--primary-red); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="grid-column: 1 / -1;">
                    <label for="keluhan" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Keluhan <span style="color: var(--primary-red);">*</span></label>
                    <textarea name="keluhan" id="keluhan" required rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('keluhan', $servis->keluhan) }}</textarea>
                    @error('keluhan')
                        <span style="color: var(--primary-red); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="grid-column: 1 / -1;">
                    <label for="tindakan" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Tindakan</label>
                    <textarea name="tindakan" id="tindakan" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('tindakan', $servis->tindakan) }}</textarea>
                    @error('tindakan')
                        <span style="color: var(--primary-red); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="biaya" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Biaya (Rp)</label>
                    <input type="number" name="biaya" id="biaya" min="0" step="1000" value="{{ old('biaya', $servis->biaya) }}" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                    @error('biaya')
                        <span style="color: var(--primary-red); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="status" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Status <span style="color: var(--primary-red);">*</span></label>
                    <select name="status" id="status" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                        <option value="pending" {{ old('status', $servis->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="proses" {{ old('status', $servis->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ old('status', $servis->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <span style="color: var(--primary-red); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('servis.index') }}" class="btn" style="background: #6c757d;">Batal</a>
            </div>
        </form>
    </div>
@endsection
