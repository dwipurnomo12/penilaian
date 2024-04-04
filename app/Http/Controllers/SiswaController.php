<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('siswa.index', [
            'siswas'    => Siswa::with('kelas')->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create', [
            'kelases'   => Kelas::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nm_siswa'  => 'required',
            'nis'       => 'required|unique:siswas',
            'no_hp'     => 'required',
            'j_kelamin' => 'required',
            'alamat'    => 'required',
            'password'  => 'required',
            'kelas_id'  => 'required',
        ], [
            'nm_siswa.required'  => 'Form tidak boleh kosong !',
            'nis.required'       => 'Form tidak boleh kosong !',
            'nis.unique'         => 'NIS sudah digunakan !',
            'no_hp.required'     => 'Form tidak boleh kosong !',
            'j_kelamin.required' => 'Form tidak boleh kosong !',
            'alamat.required'    => 'Form tidak boleh kosong !',
            'password.required'  => 'Form tidak boleh kosong !',
            'kelas_id.required'  => 'Pilih kelas !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username'      => $request->nis,
            'password'      => Hash::make($request->password),
        ]);

        Siswa::create([
            'nm_siswa'  => $request->nm_siswa,
            'nis'       => $request->nis,
            'no_hp'     => $request->no_hp,
            'j_kelamin' => $request->j_kelamin,
            'alamat'    => $request->alamat,
            'user_id'   => $user->id,
            'kelas_id'  => $request->kelas_id
        ]);

        return redirect('/siswa')->with('success', 'Berhasil menambahkan data baru !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::with('kelas')->find($id);
        return view('siswa.edit', [
            'kelases'   => Kelas::all(),
            'siswa'     => $siswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::with('kelas')->findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nm_siswa'  => 'required',
            'nis'       => 'required|unique:siswas,nis,' . $id,
            'no_hp'     => 'required',
            'j_kelamin' => 'required',
            'alamat'    => 'required',
            'kelas_id'  => 'required',
        ], [
            'nm_siswa.required'  => 'Form tidak boleh kosong!',
            'nis.required'       => 'Form tidak boleh kosong!',
            'nis.unique'         => 'NIS sudah digunakan!',
            'no_hp.required'     => 'Form tidak boleh kosong!',
            'j_kelamin.required' => 'Form tidak boleh kosong!',
            'alamat.required'    => 'Form tidak boleh kosong!',
            'kelas_id.required'  => 'Pilih kelas!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $siswa->update([
            'nm_siswa'  => $request->nm_siswa,
            'nis'       => $request->nis,
            'no_hp'     => $request->no_hp,
            'j_kelamin' => $request->j_kelamin,
            'alamat'    => $request->alamat,
            'kelas_id'  => $request->kelas_id,
        ]);

        if (!empty($request->password)) {
            $user = User::find($siswa->user_id);

            if ($user) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }
        }

        return redirect('/siswa')->with('success', 'Berhasil memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::with('kelas')->findOrFail($id);
        $siswa->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data !');
    }
}
