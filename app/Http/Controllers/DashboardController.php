<?php

namespace App\Http\Controllers;

use App\Models\Servis;
use App\Models\Motor;
use App\Models\Pelanggan;
use App\Models\Mekanik;
use App\Models\Sparepart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // If user is a customer, show their servis data only
        if ($user->isPelanggan()) {
            $pelanggan = $user->pelanggan;

            if (!$pelanggan) {
                return view('dashboard.customer-no-data');
            }

            $servisList = Servis::where('pelanggan_id', $pelanggan->id)
                ->with(['motor', 'mekanik'])
                ->orderBy('created_at', 'desc')
                ->get();

            $stats = [
                'total_servis' => $servisList->count(),
                'servis_selesai' => $servisList->where('status', 'selesai')->count(),
                'total_pembayaran' => $servisList->sum('biaya'),
                'pembayaran_lunas' => $servisList->where('status', 'selesai')->sum('biaya'),
            ];

            return view('dashboard.customer', compact('stats', 'servisList', 'pelanggan'));
        }

        // Admin view
        $stats = [
            'total_servis' => Servis::count(),
            'servis_selesai' => Servis::where('status', 'selesai')->count(),
            'total_motor' => Motor::count(),
            'total_pelanggan' => Pelanggan::count(),
        ];

        // Get recent data for tables
        $recentServis = Servis::with(['pelanggan', 'motor', 'mekanik'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentMotor = Motor::with('pelanggan')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentPelanggan = Pelanggan::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $lowStockSpareparts = Sparepart::whereRaw('stok <= minimal_stok')
            ->orderBy('stok', 'asc')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact('stats', 'recentServis', 'recentMotor', 'recentPelanggan', 'lowStockSpareparts'));
    }
}

