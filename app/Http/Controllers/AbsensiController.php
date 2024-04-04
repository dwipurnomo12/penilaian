<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('absensi.index', [
            'absensis'      => Absensi::with(['siswa', 'tahun_ajaran'])
                ->whereHas('tahun_ajaran', function ($query) {
                    $query->where('status', 'aktif');
                })
                ->get(),
            'tahunAjarans'  => TahunAjaran::all()
        ]);
    }

    public function filterData(Request $request)
    {
        $tahunAjaranId = $request->input('tahun_ajaran_id');
        $tahunAjarans  = TahunAjaran::all();

        $absensis = Absensi::when($tahunAjaranId, function ($query) use ($tahunAjaranId) {
            return $query->where('tahun_ajaran_id', $tahunAjaranId);
        })->get();

        return view('absensi.index', compact('absensis', 'tahunAjarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guruId     = Auth::user()->guru->id;
        $kelasId    = Kelas::where('guru_id', $guruId)->value('id');
        $siswas     = Siswa::where('kelas_id', $kelasId)->get();

        $tahun_ajarans = TahunAjaran::where('status', 'aktif')->get();

        return view('absensi.create', compact('siswas', 'tahun_ajarans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran_id' => 'required',
            'absensi' => 'required|array',
            'absensi.*.sakit' => 'required|numeric|min:0',
            'absensi.*.izin' => 'required|numeric|min:0',
            'absensi.*.tanpa_keterangan' => 'required|numeric|min:0',
        ]);

        foreach ($request->absensi as $siswaId => $absensiData) {
            Absensi::updateOrCreate(
                ['siswa_id' => $siswaId, 'tahun_ajaran_id' => $request->tahun_ajaran_id],
                $absensiData
            );
        }

        return redirect('/absensi')->with('success', 'Data absensi berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $absensi = Absensi::find($id);
        return view('absensi.edit', [
            'absensi'   => $absensi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'sakit' => 'required|integer|min:0',
            'izin' => 'required|integer|min:0',
            'tanpa_keterangan' => 'required|integer|min:0',
        ]);

        $absensi = Absensi::find($id);
        if (!$absensi) {
            return redirect()->back()->with('error', 'Data absensi tidak ditemukan.');
        }

        $absensi->update([
            'sakit' => $request->sakit,
            'izin' => $request->izin,
            'tanpa_keterangan' => $request->tanpa_keterangan,
        ]);

        return redirect('/absensi')->with('success', 'Data absensi berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
