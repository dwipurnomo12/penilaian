@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h4>Edit Data Tahun Ajaran</h4>
                            </div>
                        </div>
                    </div>
                    <form action="/tahun-ajaran/{{ $tahunAjaran->id }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label for="tahun_ajaran">Tahun Ajaran <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="tahun_ajaran"
                                    value="{{ old('tahun_ajaran', $tahunAjaran->tahun_ajaran) }}">
                                @error('tahun_ajaran')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="text">Semester <span style="color: red">*</span></label>
                                <select class="form-control" name="semester" id="semester">
                                    @foreach (['ganjil', 'genap'] as $semester)
                                        <option value="{{ $semester }}"
                                            @if ($semester == $tahunAjaran->semester) selected @endif>
                                            {{ ucfirst($semester) }}</option>
                                    @endforeach
                                </select>
                                @error('semester')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="text">Status <span style="color: red">*</span></label>
                                <select class="form-control" name="status" id="status">
                                    @foreach (['aktif', 'tidak aktif'] as $status)
                                        <option value="{{ $status }}"
                                            @if ($status == $tahunAjaran->status) selected @endif>
                                            {{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success float-right mb-3 mr-2"><i class="fa fa-save"></i>
                                Simpan</button>
                            <a href="/tahun-ajaran" class="btn btn-secondary float-right mb-3 mr-2"><i
                                    class="fa fa-arrow-left"></i>
                                Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
