@extends('layouts.app')

@section('title', 'Data Motor | PitTel Moto')

@section('content')
    <div class="card-header">
        <h1>Data Motor</h1>
        <a href="{{ route('motor.create') }}" class="btn btn-primary">+ Tambah Motor</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="background: #e5f5e5; color: #28a745; border-left: 4px solid #28a745; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Plat Nomor</th>
                    <th>Merk & Model</th>
                    <th>Tahun</th>
                    <th>Warna</th>
                    <th>Pemilik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($motors as $motor)
                    <tr>
                        <td>{{ $loop->iteration + ($motors->currentPage() - 1) * $motors->perPage() }}</td>
                        <td><strong>{{ $motor->plat_nomor }}</strong></td>
                        <td>{{ $motor->merk }} {{ $motor->model }}</td>
                        <td>{{ $motor->tahun ?? '-' }}</td>
                        <td>{{ $motor->warna ?? '-' }}</td>
                        <td>{{ $motor->pelanggan->nama ?? '-' }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('motor.edit', $motor->id) }}" class="btn" style="background: #ffc107; color: #333; padding: 0.4rem 0.8rem; font-size: 0.85rem;">Edit</a>
                                <form action="{{ route('motor.destroy', $motor->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="background: #dc3545; color: white; padding: 0.4rem 0.8rem; font-size: 0.85rem;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem; color: #999;">
                            Belum ada data motor.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($motors->hasPages())
            <div style="padding: 1.5rem; display: flex; justify-content: center; gap: 0.5rem;">
                {{ $motors->links() }}
            </div>
        @endif
    </div>
@endsection
