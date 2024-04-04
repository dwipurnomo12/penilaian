@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h4>Edit Data Absensi</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/absensi/{{ $absensi->id }}" method="POST">
                            @method('put')
                            @csrf
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
                                            <tr>
                                                <td>{{ $absensi->siswa->nm_siswa }}</td>
                                                <td>
                                                    <input type="number" name="sakit" class="form-control" min="0"
                                                        value="{{ $absensi->sakit }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="izin" class="form-control" min="0"
                                                        value="{{ $absensi->izin }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="tanpa_keterangan" class="form-control"
                                                        min="0" value="{{ $absensi->tanpa_keterangan }}">
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
