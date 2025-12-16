<?php

namespace App\Http\Controllers;

use App\Models\Mekanik;
use Illuminate\Http\Request;

class MekanikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mekaniks = Mekanik::withCount('servis')->orderBy('nama')->paginate(15);
        return view('mekanik.index', compact('mekaniks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mekanik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'spesialisasi' => 'nullable|string|max:255',
            'aktif' => 'required|boolean',
        ]);

        Mekanik::create($validated);

        return redirect()->route('mekanik.index')->with('success', 'Data mekanik berhasil ditambahkan');
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
    public function edit(Mekanik $mekanik)
    {
        return view('mekanik.edit', compact('mekanik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mekanik $mekanik)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'spesialisasi' => 'nullable|string|max:255',
            'aktif' => 'required|boolean',
        ]);

        $mekanik->update($validated);

        return redirect()->route('mekanik.index')->with('success', 'Data mekanik berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mekanik $mekanik)
    {
        $mekanik->delete();
        return redirect()->route('mekanik.index')->with('success', 'Data mekanik berhasil dihapus');
    }
}
