<?php

namespace App\Http\Controllers;

use App\Models\Servis;
use App\Models\Motor;
use App\Models\Pelanggan;
use App\Models\Mekanik;
use Illuminate\Http\Request;

class ServisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servis = Servis::with(['pelanggan', 'motor', 'mekanik'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('servis.index', compact('servis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama')->get();
        $motors = Motor::with('pelanggan')->orderBy('plat_nomor')->get();
        $mekaniks = Mekanik::where('aktif', true)->orderBy('nama')->get();

        return view('servis.create', compact('pelanggans', 'motors', 'mekaniks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'motor_id' => 'required|exists:motors,id',
            'mekanik_id' => 'nullable|exists:mekaniks,id',
            'keluhan' => 'required|string',
            'tindakan' => 'nullable|string',
            'biaya' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,proses,selesai',
            'tanggal_servis' => 'required|date',
        ]);

        Servis::create($validated);

        return redirect()->route('servis.index')->with('success', 'Data servis berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $servis = Servis::with(['pelanggan', 'motor', 'mekanik'])->findOrFail($id);
        return view('servis.show', compact('servis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $servis = Servis::findOrFail($id);
        $pelanggans = Pelanggan::orderBy('nama')->get();
        $motors = Motor::with('pelanggan')->orderBy('plat_nomor')->get();
        $mekaniks = Mekanik::where('aktif', true)->orderBy('nama')->get();

        return view('servis.edit', compact('servis', 'pelanggans', 'motors', 'mekaniks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $servis = Servis::findOrFail($id);

        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'motor_id' => 'required|exists:motors,id',
            'mekanik_id' => 'nullable|exists:mekaniks,id',
            'keluhan' => 'required|string',
            'tindakan' => 'nullable|string',
            'biaya' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,proses,selesai',
            'tanggal_servis' => 'required|date',
        ]);

        $servis->update($validated);

        return redirect()->route('servis.index')->with('success', 'Data servis berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $servis = Servis::findOrFail($id);
        $servis->delete();

        return redirect()->route('servis.index')->with('success', 'Data servis berhasil dihapus');
    }
}
