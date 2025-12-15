<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::paginate(10);
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'id_anggota' => 'required|unique:anggota,id_anggota', // Auto generated now
            'nama' => 'required',
            'alamat' => 'nullable',
            'no_telepon' => 'nullable',
            'email' => 'nullable|email',
            'tanggal_daftar' => 'required|date',
            'tanggal_berlaku' => 'required|date|after_or_equal:tanggal_daftar',
            'tanggal_expire' => 'required|date|after:tanggal_berlaku',
        ]);

        // Auto Generate ID Anggota (A001)
        $latest = Anggota::orderBy('id_anggota', 'desc')->first();
        if (!$latest) {
            $newId = 'A001';
        } else {
            // Extract number, assuming format Axxx
            $number = intval(substr($latest->id_anggota, 1)) + 1;
            $newId = 'A' . str_pad($number, 3, '0', STR_PAD_LEFT);
        }

        $data = $request->all();
        $data['id_anggota'] = $newId;

        Anggota::create($data);

        return redirect()->route('anggota.index')
                         ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function show(Anggota $anggota)
    {
        return view('anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'id_anggota' => ['required', Rule::unique('anggota', 'id_anggota')->ignore($anggota->id)],
            'nama' => 'required',
            'alamat' => 'nullable',
            'no_telepon' => 'nullable',
            'email' => 'nullable|email',
            'tanggal_daftar' => 'required|date',
            'tanggal_berlaku' => 'required|date|after_or_equal:tanggal_daftar',
            'tanggal_expire' => 'required|date|after:tanggal_berlaku',
        ]);

        $anggota->update($request->all());

        return redirect()->route('anggota.index')
                         ->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return redirect()->route('anggota.index')
                         ->with('success', 'Anggota berhasil dihapus.');
    }
}
