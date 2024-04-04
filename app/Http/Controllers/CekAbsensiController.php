<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\pdf as PDF;

class CekAbsensiController extends Controller
{
    public function index()
    {
        $siswa_id = auth()->user()->siswa->id;
        return view('cek-absensi.index', [
            'absensis'      => Absensi::with(['siswa', 'tahun_ajaran'])
                ->where('siswa_id', $siswa_id)
                ->get(),
            'tahunAjarans'  => TahunAjaran::all()
        ]);
    }

    public function cetakAbsensi()
    {
        $siswa_id = auth()->user()->siswa->id;
        $absensis = Absensi::with(['siswa', 'tahun_ajaran'])
            ->where('siswa_id', $siswa_id)
            ->get();

        $pdf = PDF::loadView('cek-absensi.cetak-absensi', ['absensis' => $absensis]);
        return $pdf->stream('absensi.pdf');
    }
}
