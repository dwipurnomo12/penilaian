@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h4>Tambah Data Nilai</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/penilaian" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="siswa_id">Siswa</label>
                                        <select name="siswa_id" id="siswa_id" class="form-control">
                                            @foreach ($siswas as $siswa)
                                                <option value="{{ $siswa->id }}">{{ $siswa->nm_siswa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mata_pelajaran_id">Mata Pelajaran</label>
                                        <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-control">
                                            @foreach ($mata_pelajarans as $mata_pelajaran)
                                                <option value="{{ $mata_pelajaran->id }}">
                                                    {{ $mata_pelajaran->mata_pelajaran }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tahun_ajaran_id">Tahun Ajaran</label>
                                        <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control">
                                            @foreach ($tahun_ajarans as $tahun_ajaran)
                                                <option value="{{ $tahun_ajaran->id }}">{{ $tahun_ajaran->tahun_ajaran }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @foreach ($jenis_nilais as $jenis_nilai)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label
                                                for="jenis_nilai_{{ $jenis_nilai->id }}">{{ $jenis_nilai->jenis_nilai }}</label>
                                            <input type="number" name="nilai[{{ $jenis_nilai->id }}]"
                                                id="jenis_nilai_{{ $jenis_nilai->id }}" class="form-control">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary">Tambah Nilai</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
