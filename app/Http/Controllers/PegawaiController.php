<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nip' => 'required|unique:pegawai',
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email|unique:pegawai',
            'jabatan' => 'required',
            'unit_kerja' => 'required',
            'pangkat_golongan' => 'required',
        ]);

        // Simpan data ke dalam database
        Pegawai::create($validatedData);

        // Redirect ke halaman yang sesuai
        return redirect('/data-pegawai')->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function index()
    {
        $pegawai = Pegawai::all();
        return view('data-pegawai', compact('pegawai'));
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('edit-pegawai', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nip' => 'required|unique:pegawai,nip,'.$id,
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email|unique:pegawai,email,'.$id,
            'jabatan' => 'required',
            'unit_kerja' => 'required',
            'pangkat_golongan' => 'required',
        ]);

        // Update data pegawai
        Pegawai::whereId($id)->update($validatedData);

        // Redirect ke halaman yang sesuai
        return redirect('/data-pegawai')->with('success', 'Data pegawai berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        // Redirect ke halaman yang sesuai
        return redirect('/data-pegawai')->with('success', 'Data pegawai berhasil dihapus');
    }
}