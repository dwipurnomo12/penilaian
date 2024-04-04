<!-- Di view -->
@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6">
                                <h4>Data Nilai</h4>
                            </div>
                            <div class="col-6">
                                <a href="/penilaian/create" class="btn btn-primary float-right">Tambah Data</a>
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
                            <form action="/penilaian/filter-data" method="GET">
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

                                                    <a href="/penilaian/" class="btn btn-sm btn-danger ml-1"
                                                        id="refresh_btn"><i class="fa fa-solid fa-rotate-right"></i>
                                                        Refresh</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="kelas">Kelas</label>
                                    <input type="text" class="form-control" name="kelas" value="{{ $kelas }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="kelas">Wali Kelas</label>
                                    <input type="text" class="form-control" name="kelas" value="{{ $guru }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="tahun_ajaran">Tahun Ajaran & Semester</label>
                                    <input type="text" class="form-control" name="tahun_ajaran"
                                        value="{{ $penilaians->isNotEmpty() ? $penilaians->first()->tahun_ajaran->tahun_ajaran . ' - ' . $penilaians->first()->tahun_ajaran->semester : '' }}"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive
                                        p-2">
                            <table id="table_id" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Siswa</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Jenis Nilai</th>
                                        <th>Nilai</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $current_student = null; @endphp
                                    @foreach ($penilaians as $key => $penilaian)
                                        @if ($current_student != $penilaian->siswa->nm_siswa)
                                            <tr>
                                                <td
                                                    rowspan="{{ $penilaians->where('siswa_id', $penilaian->siswa_id)->count() }}">
                                                    {{ $penilaian->siswa->nm_siswa }}</td>
                                                @php $current_student = $penilaian->siswa->nm_siswa; @endphp
                                        @endif
                                        <td>{{ $penilaian->mata_pelajaran->mata_pelajaran }}</td>
                                        <td>{{ $penilaian->jenis_nilai->jenis_nilai }}</td>
                                        <td>{{ $penilaian->nilai }}</td>
                                        @if ($key == 0 || $penilaian->mata_pelajaran_id != $penilaians[$key - 1]->mata_pelajaran_id)
                                            <td>
                                                <a href="{{ route('penilaian.editData', ['mata_pelajaran_id' => $penilaian->mata_pelajaran_id, 'siswa_id' => $penilaian->siswa_id]) }}"
                                                    class="btn btn-warning"><i class="fas fa-edit"></i></a>

                                                <form id="{{ $penilaian->id }}" action="/penilaian/{{ $penilaian->id }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger swal-confirm"
                                                        data-form="{{ $penilaian->id }}"><i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif

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
@endsection
