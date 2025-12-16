@extends('layouts.app')

@section('title', 'Data Servis | PitTel Moto')

@section('content')
    <div class="card-header">
        <h1>Data Servis Motor</h1>
        <a href="{{ route('servis.create') }}" class="btn btn-primary">+ Tambah Servis</a>
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
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Motor</th>
                    <th>Keluhan</th>
                    <th>Mekanik</th>
                    <th>Status</th>
                    <th>Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($servis as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($servis->currentPage() - 1) * $servis->perPage() }}</td>
                        <td>{{ $item->tanggal_servis ? $item->tanggal_servis->format('d/m/Y') : '-' }}</td>
                        <td>{{ $item->pelanggan->nama ?? '-' }}</td>
                        <td>{{ $item->motor ? $item->motor->merk . ' ' . $item->motor->model . ' (' . $item->motor->plat_nomor . ')' : '-' }}</td>
                        <td>{{ \Str::limit($item->keluhan, 40) }}</td>
                        <td>{{ $item->mekanik->nama ?? '-' }}</td>
                        <td>
                            @if($item->status == 'selesai')
                                <span style="background: #28a745; color: white; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">Selesai</span>
                            @elseif($item->status == 'proses')
                                <span style="background: #ffc107; color: #333; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">Proses</span>
                            @else
                                <span style="background: #6c757d; color: white; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">Pending</span>
                            @endif
                        </td>
                        <td>Rp {{ number_format($item->biaya, 0, ',', '.') }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('servis.edit', $item->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                                <form action="{{ route('servis.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 2rem; color: #999;">
                            Belum ada data servis. <a href="{{ route('servis.create') }}" style="color: #D60A1E; font-weight: 600;">Tambah data pertama</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($servis->hasPages())
            <div style="padding: 1.5rem; display: flex; justify-content: center; gap: 0.5rem;">
                {{ $servis->links() }}
            </div>
        @endif
    </div>

    <style>
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background: #c82333;
        }
    </style>
@endsection
