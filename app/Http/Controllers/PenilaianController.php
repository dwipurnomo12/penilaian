<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Penilaian;
use App\Models\JenisNilai;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mata_pelajaran_id = $request->input('mata_pelajaran_id');
        $penilaians = Penilaian::with(['siswa', 'mata_pelajaran', 'tahun_ajaran', 'jenis_nilai'])
            ->when($mata_pelajaran_id, function ($query) use ($mata_pelajaran_id) {
                $query->where('mata_pelajaran_id', $mata_pelajaran_id);
            })
            ->orderBy('siswa_id')
            ->orderBy('mata_pelajaran_id')
            ->get();

        $guruId         = Auth::user()->guru->id;
        $kelas          = Kelas::where('guru_id', $guruId)->value('kelas');
        $guru           = Auth::user()->guru->nm_guru;
        $tahunAjarans   = TahunAjaran::all();

        return view('penilaian.index', compact('penilaians', 'kelas', 'guru', 'tahunAjarans'));
    }

    public function filterData(Request $request)
    {
        $tahunAjaranId = $request->input('tahun_ajaran_id');
        $tahunAjarans  = TahunAjaran::all();

        $penilaians = Penilaian::when($tahunAjaranId, function ($query) use ($tahunAjaranId) {
            return $query->where('tahun_ajaran_id', $tahunAjaranId);
        })->get();
        $guruId         = Auth::user()->guru->id;
        $kelas          = Kelas::where('guru_id', $guruId)->value('kelas');
        $guru           = Auth::user()->guru->nm_guru;
        $tahunAjarans   = TahunAjaran::all();

        return view('penilaian.index', compact('penilaians', 'kelas', 'guru', 'tahunAjarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guruId     = Auth::user()->guru->id;
        $kelasId    = Kelas::where('guru_id', $guruId)->value('id');
        $siswas     = Siswa::where('kelas_id', $kelasId)->get();

        $mata_pelajarans = MataPelajaran::all();
        $tahun_ajarans = TahunAjaran::where('status', 'aktif')->get();
        $jenis_nilais = JenisNilai::all();

        return view('penilaian.create', compact('siswas', 'mata_pelajarans', 'tahun_ajarans', 'jenis_nilais'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'mata_pelajaran_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric',
        ]);

        $siswa_id = $request->siswa_id;
        $mata_pelajaran_id = $request->mata_pelajaran_id;
        $tahun_ajaran_id = $request->tahun_ajaran_id;
        $nilai = $request->nilai;

        foreach ($nilai as $jenis_nilai_id => $nilai_per_jenis) {
            Penilaian::create([
                'siswa_id' => $siswa_id,
                'mata_pelajaran_id' => $mata_pelajaran_id,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'jenis_nilai_id' => $jenis_nilai_id,
                'nilai' => $nilai_per_jenis,
            ]);
        }

        return redirect('penilaian')->with('success', 'Nilai berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($mata_pelajaran_id, $siswa_id)
    {
        $nilai = Penilaian::where('mata_pelajaran_id', $mata_pelajaran_id)
            ->where('siswa_id', $siswa_id)
            ->get();

        // Lakukan logika untuk menyiapkan formulir edit dengan data yang tepat
        return view('penilaian.edit', compact('nilai'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan oleh formulir
        $request->validate([
            // Sesuaikan dengan kebutuhan validasi Anda
            'nilai.*' => 'required|numeric',
        ]);

        // Ambil data penilaian yang akan diupdate
        $nilai = Penilaian::findOrFail($id);

        // Loop untuk mengupdate nilai sesuai dengan data yang dikirimkan oleh formulir
        foreach ($request->nilai as $jenis_nilai_id => $nilai_item) {
            // Temukan atau buat objek penilaian yang sesuai
            $penilaian = Penilaian::where('mata_pelajaran_id', $nilai->mata_pelajaran_id)
                ->where('siswa_id', $nilai->siswa_id)
                ->where('jenis_nilai_id', $jenis_nilai_id)
                ->firstOrNew();

            // Tetapkan nilai yang baru
            $penilaian->nilai = $nilai_item;

            // Simpan perubahan
            $penilaian->save();
        }

        // Redirect ke halaman yang sesuai setelah berhasil melakukan update
        return redirect('/penilaian')->with('success', 'Data penilaian berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->back()->with('success', 'Data penilaian berhasil dihapus.');
    }
}