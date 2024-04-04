<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('guru.index', [
            'gurus'     => Guru::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nm_guru'  => 'required',
            'nip'       => 'required|unique:gurus',
            'no_hp'     => 'required',
            'j_kelamin' => 'required',
            'alamat'    => 'required',
            'password'  => 'required',
        ], [
            'nm_guru.required'  => 'Form tidak boleh kosong !',
            'nip.required'       => 'Form tidak boleh kosong !',
            'nip.unique'         => 'NIP sudah digunakan !',
            'no_hp.required'     => 'Form tidak boleh kosong !',
            'j_kelamin.required' => 'Form tidak boleh kosong !',
            'alamat.required'    => 'Form tidak boleh kosong !',
            'password.required'  => 'Form tidak boleh kosong !',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username'      => $request->nip,
            'password'      => Hash::make($request->password),
        ]);

        Guru::create([
            'nm_guru'   => $request->nm_guru,
            'nip'       => $request->nip,
            'no_hp'     => $request->no_hp,
            'j_kelamin' => $request->j_kelamin,
            'alamat'    => $request->alamat,
            'user_id'   => $user->id,
        ]);

        return redirect('/guru')->with('success', 'Berhasil menambahkan data baru !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guru = Guru::find($id);
        return view('guru.edit', [
            'guru'     => $guru
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guru = Guru::find($id);
        $validator = Validator::make($request->all(), [
            'nm_guru'  => 'required',
            'nip'       => 'required|unique:gurus,nip,' . $id,
            'no_hp'     => 'required',
            'j_kelamin' => 'required',
            'alamat'    => 'required',
        ], [
            'nm_guru.required'   => 'Form tidak boleh kosong!',
            'nip.required'       => 'Form tidak boleh kosong!',
            'nip.unique'         => 'NIP sudah digunakan!',
            'no_hp.required'     => 'Form tidak boleh kosong!',
            'j_kelamin.required' => 'Form tidak boleh kosong!',
            'alamat.required'    => 'Form tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $guru->update([
            'nm_guru'   => $request->nm_guru,
            'nip'       => $request->nip,
            'no_hp'     => $request->no_hp,
            'j_kelamin' => $request->j_kelamin,
            'alamat'    => $request->alamat,
        ]);

        if (!empty($request->password)) {
            $user = User::find($guru->user_id);

            if ($user) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }
        }

        return redirect('/guru')->with('success', 'Berhasil memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guru = Guru::find($id);
        $guru->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data !');
    }
}
