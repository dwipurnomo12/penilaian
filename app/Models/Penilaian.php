<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function mata_pelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
    public function jenis_nilai()
    {
        return $this->belongsTo(JenisNilai::class);
    }
}
