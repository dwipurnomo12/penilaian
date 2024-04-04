@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h4>Tambah Data Tahun Ajaran</h4>
                            </div>
                        </div>
                    </div>
                    <form action="/tahun-ajaran" method="POST">
                        @csrf
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label for="tahun_ajaran">Tahun Ajaran <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="tahun_ajaran"
                                    value="{{ old('tahun_ajaran') }}">
                                @error('tahun_ajaran')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="text">Semester <span style="color: red">*</span></label>
                                <select class="form-control" aria-label="Default select example" name="semester"
                                    value="{{ old('semester') }}">
                                    <option value="">Pilih Semester</option>
                                    <option value="ganjil">Ganjil</option>
                                    <option value="genap">Genap</option>
                                </select>
                                @error('semester')
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
