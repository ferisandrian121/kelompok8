<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianPegawai;

class PenilaianPegawaiController extends Controller
{

    
    public function index()
    {
        $penilaian = PenilaianPegawai::all();
        return view('penilaian-pegawai', compact('penilaian'));
        $penilaian = PenilaianPegawai::all(); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'tahun_penilaian' => 'required',
            'kegiatan' => 'required',
            'nilai' => 'required|in:Baik,Cukup Baik,Kurang Baik',
            'note' => 'nullable',
        ]);

        PenilaianPegawai::create($validatedData);

        return redirect('/penilaian-pegawai')->with('success', 'Penilaian berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'tahun_penilaian' => 'required',
            'kegiatan' => 'required',
            'nilai' => 'required|in:Baik,Cukup Baik,Kurang Baik',
            'note' => 'nullable',
        ]);

        PenilaianPegawai::whereId($id)->update($validatedData);

        return redirect('/penilaian-pegawai')->with('success', 'Penilaian berhasil diperbarui');
    }

    public function destroy($id)
    {
        PenilaianPegawai::destroy($id);

        return redirect('/penilaian-pegawai')->with('success', 'Penilaian berhasil dihapus');
    }
}