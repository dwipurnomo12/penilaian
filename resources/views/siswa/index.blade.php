@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6">
                                <h4>Data Siswa</h4>
                            </div>
                            <div class="col-6">
                                <a href="/siswa/create" class="btn btn-primary float-right">Tambah Data</a>
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
                                        <th class="text-left">Nama</th>
                                        <th class="text-left">NIS</th>
                                        <th class="text-left">Kelas</th>
                                        <th class="text-left">No HP</th>
                                        <th class="text-left">Jenis Kelamin</th>
                                        <th class="text-left">Alamat</th>
                                        <th class="text-left">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $siswa)
                                        <tr>
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td class="text-left">{{ $siswa->nm_siswa }}</td>
                                            <td class="text-left">{{ $siswa->nis }}</td>
                                            <td class="text-left">{{ $siswa->kelas->kelas }}</td>
                                            <td class="text-left">{{ $siswa->no_hp }}</td>
                                            <td class="text-left">{{ $siswa->j_kelamin }}</td>
                                            <td class="text-left">{{ $siswa->alamat }}</td>
                                            <td>
                                                <a href="/siswa/{{ $siswa->id }}/edit" class="btn btn-warning"><i
                                                        class="fa fa-pencil-square"></i></a>
                                                <form id="{{ $siswa->id }}" action="/siswa/{{ $siswa->id }}"
                                                    method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger swal-confirm"
                                                        data-form="{{ $siswa->id }}"><i
                                                            class="fa fa-trash-o"></i></a></button>
                                                </form>
                                            </td>
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
