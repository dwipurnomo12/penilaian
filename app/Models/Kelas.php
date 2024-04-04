<?php

namespace App\Models;

use App\Models\Guru;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function wali_kelas()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}
