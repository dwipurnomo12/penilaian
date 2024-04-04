<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\pdf as PDF;
use App\Models\Penilaian;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JenisNilai;
use Illuminate\Support\Facades\Auth;

class LaporanNilaiController extends Controller
{
    public function index(Request $request)
    {
        $mata_pelajaran_id = $request->input('mata_pelajaran_id');
        $penilaians = Penilaian::with(['siswa', 'mata_pelajaran', 'tahun_ajaran', 'jenis_nilai'])
            ->when($mata_pelajaran_id, function ($query) use ($mata_pelajaran_id) {
                $query->where('mata_pelajaran_id', $mata_pelajaran_id);
            })
            ->orderBy('siswa_id')
            ->orderBy('mata_pelajaran_id')
            ->orderBy('jenis_nilai_id')
            ->orderBy('nilai')
            ->get();

        $guruId         = Auth::user()->guru->id;
        $kelas          = Kelas::where('guru_id', $guruId)->value('kelas');
        $guru           = Auth::user()->guru->nm_guru;
        $tahunAjarans   = TahunAjaran::all();
        $tahun_ajaran_id  = $request->input('tahun_ajaran_id');

        return view('laporan-nilai.index', compact('penilaians', 'kelas', 'guru', 'tahunAjarans', 'tahun_ajaran_id'));
    }

    public function cetakNilai($siswa_id)
    {
        $nilai = Penilaian::with(['mata_pelajaran', 'tahun_ajaran', 'jenis_nilai'])
            ->where('siswa_id', $siswa_id)
            ->get();
        $jenis_nilai = JenisNilai::all();

        $pdf = PDF::loadView('laporan-nilai.nilai', [
            'penilaians'         => $nilai,
            'jenis_nilai'        => $jenis_nilai,
            'siswa_id'           => $siswa_id
        ]);

        return $pdf->stream('nilai.pdf');
    }

    public function filterData(Request $request)
    {
        $tahun_ajaran_id = $request->input('tahun_ajaran_id');
        $tahunAjarans = TahunAjaran::all();

        $penilaians = Penilaian::when($tahun_ajaran_id, function ($query) use ($tahun_ajaran_id) {
            return $query->where('tahun_ajaran_id', $tahun_ajaran_id);
        })->get();
        $guruId = Auth::user()->guru->id;
        $kelas = Kelas::where('guru_id', $guruId)->value('kelas');
        $guru = Auth::user()->guru->nm_guru;


        return view('laporan-nilai.index', compact('penilaians', 'kelas', 'guru', 'tahunAjarans', 'tahun_ajaran_id'));
    }

    public function cetakLaporan($tahun_ajaran_id)
    {
        $penilaians = Penilaian::when($tahun_ajaran_id, function ($query) use ($tahun_ajaran_id) {
            return $query->where('tahun_ajaran_id', $tahun_ajaran_id);
        })->get();

        $tahunAjarans = TahunAjaran::all();
        $guruId = Auth::user()->guru->id;
        $kelas = Kelas::where('guru_id', $guruId)->value('kelas');
        $guru = Auth::user()->guru->nm_guru;

        $pdf = PDF::loadView('laporan-nilai.cetak-laporan', [
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'penilaians'    => $penilaians,
            'kelas'         => $kelas,
            'tahunAjarans'  => $tahunAjarans,
            'guru'          => $guru
        ]);

        return $pdf->stream('cetak-laporan.pdf');
    }
}