<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajarans')->onDelete('cascade');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajarans')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_nilai_id');
            $table->foreign('jenis_nilai_id')->references('id')->on('jenis_nilais')->onDelete('cascade');
            $table->float('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
