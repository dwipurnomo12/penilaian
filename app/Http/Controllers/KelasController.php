<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kelas.index', [
            'kelases'   => Kelas::with('wali_kelas')->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.create', [
            'gurus' => Guru::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelas'     => 'required',
            'guru_id'   => 'required'
        ], [
            'kelas.required'    => 'Form tidak boleh kosong !',
            'guru_id.required'  => 'Pilih Wali Kelas !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Kelas::create([
            'kelas'     => $request->kelas,
            'guru_id'   => $request->guru_id
        ]);

        return redirect('/kelas')->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::with('wali_kelas')->find($id);
        return view('kelas.edit', [
            'gurus' => Guru::all(),
            'kelas' => $kelas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kelas = Kelas::with('wali_kelas')->find($id);
        $validator = Validator::make($request->all(), [
            'kelas'     => 'required',
            'guru_id'   => 'required'
        ], [
            'kelas.required'    => 'Form tidak boleh kosong !',
            'guru_id.required'  => 'Pilih Wali Kelas !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $kelas->update([
            'kelas'     => $request->kelas,
            'guru_id'   => $request->guru_id
        ]);

        return redirect('/kelas')->with('success', 'Berhasil memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::with('wali_kelas')->find($id);
        $kelas->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data !');
    }
}
