@extends('layouts.app')

@section('title', 'Data Pelanggan | PitTel Moto')

@section('content')
    <div class="card-header">
        <h1>Data Pelanggan</h1>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">+ Tambah Pelanggan</a>
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
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Jumlah Motor</th>
                    <th>Jumlah Servis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggans as $pelanggan)
                    <tr>
                        <td>{{ $loop->iteration + ($pelanggans->currentPage() - 1) * $pelanggans->perPage() }}</td>
                        <td><strong>{{ $pelanggan->nama }}</strong></td>
                        <td>{{ $pelanggan->telepon ?? '-' }}</td>
                        <td>{{ $pelanggan->email ?? '-' }}</td>
                        <td>{{ \Str::limit($pelanggan->alamat ?? '-', 30) }}</td>
                        <td style="text-align: center;">{{ $pelanggan->motors_count }}</td>
                        <td style="text-align: center;">{{ $pelanggan->servis_count }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn" style="background: #ffc107; color: #333; padding: 0.4rem 0.8rem; font-size: 0.85rem;">Edit</a>
                                <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="background: #dc3545; color: white; padding: 0.4rem 0.8rem; font-size: 0.85rem;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2rem; color: #999;">
                            Belum ada data pelanggan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($pelanggans->hasPages())
            <div style="padding: 1.5rem; display: flex; justify-content: center; gap: 0.5rem;">
                {{ $pelanggans->links() }}
            </div>
        @endif
    </div>
@endsection
