@extends('layouts.app')

@section('title', 'Data Sparepart | PitTel Moto')

@section('content')
    <div class="card-header">
        <h1>Data Sparepart</h1>
        <a href="{{ route('sparepart.create') }}" class="btn btn-primary">+ Tambah Sparepart</a>
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
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Min. Stok</th>
                    <th>Harga</th>
                    <th>Satuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($spareparts as $sparepart)
                    <tr>
                        <td>{{ $loop->iteration + ($spareparts->currentPage() - 1) * $spareparts->perPage() }}</td>
                        <td>{{ $sparepart->kode ?? '-' }}</td>
                        <td><strong>{{ $sparepart->nama }}</strong></td>
                        <td style="text-align: center;">{{ $sparepart->stok }}</td>
                        <td style="text-align: center;">{{ $sparepart->minimal_stok }}</td>
                        <td>Rp {{ number_format($sparepart->harga, 0, ',', '.') }}</td>
                        <td>{{ $sparepart->satuan }}</td>
                        <td>
                            @if($sparepart->stok <= $sparepart->minimal_stok)
                                <span style="background: #dc3545; color: white; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">Stok Menipis</span>
                            @else
                                <span style="background: #28a745; color: white; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">Tersedia</span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('sparepart.edit', $sparepart->id) }}" class="btn" style="background: #ffc107; color: #333; padding: 0.4rem 0.8rem; font-size: 0.85rem;">Edit</a>
                                <form action="{{ route('sparepart.destroy', $sparepart->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="background: #dc3545; color: white; padding: 0.4rem 0.8rem; font-size: 0.85rem;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 2rem; color: #999;">
                            Belum ada data sparepart.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($spareparts->hasPages())
            <div style="padding: 1.5rem; display: flex; justify-content: center; gap: 0.5rem;">
                {{ $spareparts->links() }}
            </div>
        @endif
    </div>
@endsection
