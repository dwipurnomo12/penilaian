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
                                @if ($tahun_ajaran_id)
                                    <a href="{{ route('cetakLaporanAbsensi', ['tahun_ajaran_id' => $tahun_ajaran_id]) }}"
                                        class="btn btn-danger float-right"><i class="fas fa-print"></i> Print Laporan</a>
                                @else
                                    <button class="btn btn-danger float-right disabled" disabled><i class="fas fa-info"></i>
                                        Pilih Tahun Ajaran Untuk Print Data </button>
                                @endif
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

                        <div class="form-group">
                            <form action="/laporan-absensi/filter-data" method="GET">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="text">Filter Berdasarkan Tahun Ajaran</label>
                                            <div class="input-group">
                                                <select class="form-control" aria-label="Default select example"
                                                    name="tahun_ajaran_id">
                                                    <option value="">Pilih Tahun Ajaran</option>
                                                    @foreach ($tahunAjarans as $tahun_ajaran)
                                                        <option value="{{ $tahun_ajaran->id }}"
                                                            {{ request('tahun_ajaran_id') == $tahun_ajaran->id ? 'selected' : '' }}>
                                                            {{ $tahun_ajaran->tahun_ajaran }} -
                                                            {{ $tahun_ajaran->semester }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="ml-2 mt-1">
                                                    <button type="submit" class="btn btn-sm btn-primary"><i
                                                            class="fa-solid fa-magnifying-glass"></i> Filter</button>

                                                    <a href="/laporan-absensi/" class="btn btn-sm btn-danger ml-1"
                                                        id="refresh_btn"><i class="fa fa-solid fa-rotate-right"></i>
                                                        Refresh</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

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
