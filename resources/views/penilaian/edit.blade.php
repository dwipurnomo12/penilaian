@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h4>Edit Data Penilaian</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/penilaian/{{ $nilai->first()->id }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="siswa_id">Siswa</label>
                                        <select name="siswa_id" id="siswa_id" class="form-control" disabled>
                                            <option value="{{ $nilai->first()->siswa_id }}">
                                                {{ $nilai->first()->siswa->nm_siswa }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mata_pelajaran_id">Mata Pelajaran</label>
                                        <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-control"
                                            disabled>
                                            <option value="{{ $nilai->first()->mata_pelajaran_id }}">
                                                {{ $nilai->first()->mata_pelajaran->mata_pelajaran }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tahun_ajaran_id">Tahun Ajaran</label>
                                        <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control" disabled>
                                            <option value="{{ $nilai->first()->tahun_ajaran_id }}">
                                                {{ $nilai->first()->tahun_ajaran->tahun_ajaran }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @foreach ($nilai as $item)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label
                                                for="jenis_nilai_{{ $item->jenis_nilai_id }}">{{ $item->jenis_nilai->jenis_nilai }}</label>
                                            <input type="text" name="nilai[{{ $item->jenis_nilai_id }}]"
                                                id="jenis_nilai_{{ $item->jenis_nilai_id }}" class="form-control"
                                                value="{{ $item->nilai }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
