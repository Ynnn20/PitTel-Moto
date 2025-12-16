@extends('layouts.app')

@section('title', 'Data Mekanik | PitTel Moto')

@section('content')
    <div class="card-header">
        <h1>Data Mekanik</h1>
        <a href="{{ route('mekanik.create') }}" class="btn btn-primary">+ Tambah Mekanik</a>
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
                    <th>Nama</th>
                    <th>Spesialisasi</th>
                    <th>Telepon</th>
                    <th>Status</th>
                    <th>Jumlah Servis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mekaniks as $mekanik)
                    <tr>
                        <td>{{ $loop->iteration + ($mekaniks->currentPage() - 1) * $mekaniks->perPage() }}</td>
                        <td><strong>{{ $mekanik->nama }}</strong></td>
                        <td>{{ $mekanik->spesialisasi ?? '-' }}</td>
                        <td>{{ $mekanik->telepon ?? '-' }}</td>
                        <td>
                            @if($mekanik->aktif)
                                <span style="background: #28a745; color: white; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">Aktif</span>
                            @else
                                <span style="background: #6c757d; color: white; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">Tidak Aktif</span>
                            @endif
                        </td>
                        <td style="text-align: center;">{{ $mekanik->servis_count }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('mekanik.edit', $mekanik->id) }}" class="btn" style="background: #ffc107; color: #333; padding: 0.4rem 0.8rem; font-size: 0.85rem;">Edit</a>
                                <form action="{{ route('mekanik.destroy', $mekanik->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                            Belum ada data mekanik.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($mekaniks->hasPages())
            <div style="padding: 1.5rem; display: flex; justify-content: center; gap: 0.5rem;">
                {{ $mekaniks->links() }}
            </div>
        @endif
    </div>
@endsection
