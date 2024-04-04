@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6">
                                <h4>Data Absensi</h4>
                            </div>
                            <div class="col-6">
                                <a href="/cek-absensi/cetak-absensi" class="btn btn-danger float-right">Cetak Laporan</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif

                        <div class="table-responsive p-2">
                            <table id="table_id" class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th class="text-left">No</th>
                                        <th class="text-left">Tahun Ajaran</th>
                                        <th class="text-left">Nama Siswa</th>
                                        <th class="text-left">Sakit</th>
                                        <th class="text-left">Izin</th>
                                        <th class="text-left">Tanpa Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensis as $absensi)
                                        <tr>
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td class="text-left">{{ $absensi->tahun_ajaran->tahun_ajaran }} -
                                                {{ $absensi->tahun_ajaran->semester }}</td>
                                            <td class="text-left">{{ $absensi->siswa->nm_siswa }}</td>
                                            <td class="text-left">{{ $absensi->sakit }} Hari</td>
                                            <td class="text-left">{{ $absensi->izin }} Hari</td>
                                            <td class="text-left">{{ $absensi->tanpa_keterangan }} Hari</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Datatables Jquery -->
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
@endsection
