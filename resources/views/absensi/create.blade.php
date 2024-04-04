@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h4>Input Data Absensi</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('absensi.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tahun_ajaran">Tahun Ajaran Aktif</label>
                                        <select name="tahun_ajaran_id" id="tahun_ajaran" class="form-control">
                                            @foreach ($tahun_ajarans as $tahun_ajaran)
                                                <option value="{{ $tahun_ajaran->id }}">{{ $tahun_ajaran->tahun_ajaran }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Siswa</th>
                                                <th>Sakit</th>
                                                <th>Izin</th>
                                                <th>Tanpa Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswas as $siswa)
                                                <tr>
                                                    <td>{{ $siswa->nm_siswa }}</td>
                                                    <td>
                                                        <input type="number" name="absensi[{{ $siswa->id }}][sakit]"
                                                            class="form-control" min="0" value="0">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="absensi[{{ $siswa->id }}][izin]"
                                                            class="form-control" min="0" value="0">
                                                    </td>
                                                    <td>
                                                        <input type="number"
                                                            name="absensi[{{ $siswa->id }}][tanpa_keterangan]"
                                                            class="form-control" min="0" value="0">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
