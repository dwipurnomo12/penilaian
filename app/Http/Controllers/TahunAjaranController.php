<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tahun-ajaran.index', [
            'tahunAjarans'  => TahunAjaran::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tahun-ajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_ajaran'  => 'required',
            'semester'      => 'required',
        ], [
            'tahun_ajaran.required' => 'Form tidak boleh kosong!',
            'semester.required'     => 'Pilih Semester!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        TahunAjaran::create([
            'tahun_ajaran'  => $request->tahun_ajaran,
            'semester'      => $request->semester
        ]);

        return redirect('/tahun-ajaran')->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tahunAjaran = TahunAjaran::find($id);
        return view('tahun-ajaran.edit', [
            'tahunAjaran'   => $tahunAjaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tahunAjaran = TahunAjaran::find($id);
        $validator = Validator::make($request->all(), [
            'tahun_ajaran'  => 'required',
            'semester'      => 'required',
            'status'        => 'required'
        ], [
            'tahun_ajaran.required' => 'Form tidak boleh kosong!',
            'semester.required'     => 'Pilih Semester !',
            'status.required'       => 'Pilih Status !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $tahunAjaran->update([
            'tahun_ajaran'  => $request->tahun_ajaran,
            'semester'      => $request->semester,
            'status'        => $request->status
        ]);

        return redirect('/tahun-ajaran')->with('success', 'Berhasil memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tahunAjaran = TahunAjaran::find($id);
        $tahunAjaran->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data!');
    }
}
