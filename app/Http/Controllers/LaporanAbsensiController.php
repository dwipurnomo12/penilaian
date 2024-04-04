<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Absensi;
use Barryvdh\DomPDF\Facade\pdf as PDF;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanAbsensiController extends Controller
{
    public function index(Request $request)
    {
        return view('laporan-absensi.index', [
            'absensis'      => Absensi::with(['siswa', 'tahun_ajaran'])
                ->whereHas('tahun_ajaran', function ($query) {
                    $query->where('status', 'aktif');
                })
                ->get(),
            'tahunAjarans'  => TahunAjaran::all(),
            'tahun_ajaran_id' => $request->input('tahun_ajaran_id'),
        ]);
    }

    public function filterData(Request $request)
    {
        $tahun_ajaran_id = $request->input('tahun_ajaran_id');
        $tahunAjarans = TahunAjaran::all();

        $absensis = Absensi::when($tahun_ajaran_id, function ($query) use ($tahun_ajaran_id) {
            return $query->where('tahun_ajaran_id', $tahun_ajaran_id);
        })->get();

        return view('laporan-absensi.index', compact('tahun_ajaran_id', 'tahunAjarans', 'absensis'));
    }

    public function cetakLaporan($tahun_ajaran_id)
    {
        $absensis = Absensi::when($tahun_ajaran_id, function ($query) use ($tahun_ajaran_id) {
            return $query->where('tahun_ajaran_id', $tahun_ajaran_id);
        })->get();
        $tahunAjarans = TahunAjaran::all();
        $guruId = Auth::user()->guru->id;
        $kelas  = Kelas::where('guru_id', $guruId)->value('kelas');
        $guru = Auth::user()->guru->nm_guru;

        $pdf = PDF::loadView('laporan-absensi.laporan-absensi', [
            'tahun_ajaran_id'   => $tahun_ajaran_id,
            'absensis'          => $absensis,
            'tahunAjarans'      => $tahunAjarans,
            'kelas'             => $kelas,
            'guru'              => $guru
        ]);

        return $pdf->stream('laporan-absensi.pdf');
    }
}
