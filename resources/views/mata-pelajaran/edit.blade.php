@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h4>Edit Data Mata Pelajaran</h4>
                            </div>
                        </div>
                    </div>
                    <form action="/mata-pelajaran/{{ $mapel->id }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label for="mata_pelajaran">Mata Pelajaran <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="mata_pelajaran"
                                    value="{{ old('mata_pelajaran', $mapel->mata_pelajaran) }}">
                                @error('mata_pelajaran')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success float-right mb-3 mr-2"><i class="fa fa-save"></i>
                                Simpan</button>
                            <a href="/siswa" class="btn btn-secondary float-right mb-3 mr-2"><i
                                    class="fa fa-arrow-left"></i>
                                Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
