<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\pdf as PDF;

class CekNilaiController extends Controller
{
    public function index(Request $request)
    {
        $mata_pelajaran_id = $request->input('mata_pelajaran_id');
        $penilaians = Penilaian::with(['siswa', 'mata_pelajaran', 'tahun_ajaran', 'jenis_nilai'])
            ->where('siswa_id', auth()->user()->siswa->id)
            ->when($mata_pelajaran_id, function ($query) use ($mata_pelajaran_id) {
                $query->where('mata_pelajaran_id', $mata_pelajaran_id);
            })
            ->orderBy('siswa_id')
            ->orderBy('mata_pelajaran_id')
            ->orderBy('jenis_nilai_id')
            ->orderBy('nilai')
            ->get();
        $tahun_ajaran_id  = $request->input('tahun_ajaran_id');
        $tahunAjarans     = TahunAjaran::all();

        return view('cek-nilai.index', compact('penilaians', 'tahunAjarans', 'tahun_ajaran_id'));
    }

    public function filterData(Request $request)
    {
        $mata_pelajaran_id  = $request->input('mata_pelajaran_id');
        $tahun_ajaran_id    = $request->input('tahun_ajaran_id');
        $tahunAjarans       = TahunAjaran::all();

        $penilaians = Penilaian::with(['siswa', 'mata_pelajaran', 'tahun_ajaran', 'jenis_nilai'])
            ->whereHas('tahun_ajaran', function ($query) use ($tahun_ajaran_id) {
                $query->where('id', $tahun_ajaran_id);
            })
            ->where('siswa_id', auth()->user()->siswa->id)
            ->when($mata_pelajaran_id, function ($query) use ($mata_pelajaran_id) {
                $query->where('mata_pelajaran_id', $mata_pelajaran_id);
            })
            ->orderBy('siswa_id')
            ->orderBy('mata_pelajaran_id')
            ->orderBy('jenis_nilai_id')
            ->orderBy('nilai')
            ->get();

        return view('cek-nilai.index', compact('penilaians', 'tahunAjarans', 'tahun_ajaran_id'));
    }

    public function cetakNilai($tahun_ajaran_id)
    {
        $siswa_id = auth()->user()->siswa->id;

        $penilaians = Penilaian::with(['siswa', 'mata_pelajaran', 'tahun_ajaran', 'jenis_nilai'])
            ->where('siswa_id', $siswa_id)
            ->whereHas('tahun_ajaran', function ($query) use ($tahun_ajaran_id) {
                $query->where('id', $tahun_ajaran_id);
            })
            ->orderBy('mata_pelajaran_id')
            ->orderBy('jenis_nilai_id')
            ->get();

        $tahunAjaran = TahunAjaran::find($tahun_ajaran_id);

        $pdf = PDF::loadView('cek-nilai.cetak-nilai', [
            'tahun_ajaran' => $tahunAjaran,
            'penilaians'   => $penilaians,
        ]);

        return $pdf->stream('cetak-nilai.pdf');
    }
}
