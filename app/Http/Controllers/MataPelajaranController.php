<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mata-pelajaran.index', [
            'mataPelajarans'    => MataPelajaran::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mata-pelajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mata_pelajaran'    => 'required'
        ], [
            'mata_pelajaran.required'   => 'Form tidak boleh kosong!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        MataPelajaran::create([
            'mata_pelajaran'    => $request->mata_pelajaran
        ]);

        return redirect('/mata-pelajaran')->with('success', 'Berhasil menambahkan data !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mapel = MataPelajaran::find($id);
        return view('mata-pelajaran.edit', [
            'mapel' => $mapel
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mapel = MataPelajaran::find($id);
        $validator = Validator::make($request->all(), [
            'mata_pelajaran'    => 'required'
        ], [
            'mata_pelajaran.required'   => 'Form tidak boleh kosong!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $mapel->update([
            'mata_pelajaran'    => $request->mata_pelajaran
        ]);

        return redirect('/mata-pelajaran')->with('success', 'Berhasil memperbarui data !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mapel = MataPelajaran::find($id);
        $mapel->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data!');
    }
}
