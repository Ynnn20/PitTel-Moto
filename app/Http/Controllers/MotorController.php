<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motors = Motor::with('pelanggan')->orderBy('plat_nomor')->paginate(15);
        return view('motor.index', compact('motors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama')->get();
        return view('motor.create', compact('pelanggans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'plat_nomor' => 'required|string|unique:motors,plat_nomor',
            'merk' => 'required|string',
            'model' => 'required|string',
            'tahun' => 'nullable|integer|min:1900|max:2099',
            'warna' => 'nullable|string',
        ]);

        Motor::create($validated);

        return redirect()->route('motor.index')->with('success', 'Data motor berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motor $motor)
    {
        $pelanggans = Pelanggan::orderBy('nama')->get();
        return view('motor.edit', compact('motor', 'pelanggans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motor $motor)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'plat_nomor' => 'required|string|unique:motors,plat_nomor,' . $motor->id,
            'merk' => 'required|string',
            'model' => 'required|string',
            'tahun' => 'nullable|integer|min:1900|max:2099',
            'warna' => 'nullable|string',
        ]);

        $motor->update($validated);

        return redirect()->route('motor.index')->with('success', 'Data motor berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motor $motor)
    {
        $motor->delete();
        return redirect()->route('motor.index')->with('success', 'Data motor berhasil dihapus');
    }
}
