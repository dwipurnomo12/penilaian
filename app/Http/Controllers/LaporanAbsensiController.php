<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanAbsensiController extends Controller
{
    public function index()
    {
        return view('laporan-absensi.index', [
            'absensis'      => Absensi::with(['siswa', 'tahun_ajaran'])
                ->whereHas('tahun_ajaran', function ($query) {
                    $query->where('status', 'aktif');
                })
                ->get(),
            'tahunAjarans'  => TahunAjaran::all()
        ]);
    }
}
