<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuadran;

class KuadranController extends Controller
{

    public function index()
    {
        $kuadran = Kuadran::all();
        return view('kuadran', compact('kuadran'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required',
            'hasil_kerja' => 'required',
            'perilaku_kerja' => 'required',
        ]);

        Kuadran::create($validatedData);

        return redirect('/kuadran')->with('success', 'Data Kuadran berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nip' => 'required',
            'hasil_kerja' => 'required',
            'perilaku_kerja' => 'required',
        ]);

        Kuadran::whereId($id)->update($validatedData);

        return redirect('/kuadran')->with('success', 'Data Kuadran berhasil diperbarui');
    }

    public function destroy($id)
    {
        Kuadran::destroy($id);

        return redirect('/kuadran')->with('success', 'Data Kuadran berhasil dihapus');
    }
}