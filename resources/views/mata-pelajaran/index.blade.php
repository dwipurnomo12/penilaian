@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6">
                                <h4>Data Mata Pelajaran</h4>
                            </div>
                            <div class="col-6">
                                <a href="/mata-pelajaran/create" class="btn btn-primary float-right">Tambah Data</a>
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
                                        <th class="text-left">Mata Pelajaran</th>
                                        <th class="text-left">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mataPelajarans as $mapel)
                                        <tr>
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td class="text-left">{{ $mapel->mata_pelajaran }}</td>
                                            <td>
                                                <a href="/mata-pelajaran/{{ $mapel->id }}/edit"
                                                    class="btn btn-warning"><i class="fa fa-pencil-square"></i></a>
                                                <form id="{{ $mapel->id }}" action="/mata-pelajaran/{{ $mapel->id }}"
                                                    method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger swal-confirm"
                                                        data-form="{{ $mapel->id }}"><i
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
