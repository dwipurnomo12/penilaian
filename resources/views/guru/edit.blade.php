@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h4>Edit Data Guru</h4>
                            </div>
                        </div>
                    </div>
                    <form action="/guru/{{ $guru->id }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <label for="nm_guru">Nama Lengkap <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="nm_guru"
                                            value="{{ old('nm_guru', $guru->nm_guru) }}">
                                        @error('nm_guru')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nip">Nomor Induk Pegawai (NIP)<span
                                                style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="nip"
                                            value="{{ old('nip', $guru->nip) }}">
                                        @error('nip')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="text">Jenis Kelamin <span style="color: red">*</span></label>
                                        <select class="form-control" name="j_kelamin" id="j_kelamin">
                                            @foreach (['laki-laki', 'perempuan'] as $j_kelamin)
                                                <option value="{{ $j_kelamin }}"
                                                    @if ($j_kelamin == $guru->j_kelamin) selected @endif>
                                                    {{ ucfirst($j_kelamin) }}</option>
                                            @endforeach
                                        </select>
                                        @error('j_kelamin')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <label for="no_hp">Nomor HP<span style="color: red">*</span></label>
                                        <input type="number" class="form-control" name="no_hp"
                                            value="{{ old('no_hp', $guru->no_hp) }}">
                                        @error('no_hp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat">Alamat <span style="color: red">*</span></label>
                                        <textarea class="form-control" name="alamat" rows="5">{{ $guru->alamat }}</textarea>
                                        @error('alamat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-2">Password</label>
                                        <input class="form-control" type="password" name="password"
                                            placeholder="Kosongkan password jika tidak ingin diubah">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-2">Konfirmasi Password</label>
                                        <input class="form-control" type="password" name="confirmPassword"
                                            placeholder="Masukan konfirmasi password">
                                        @error('confirmPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success float-right mb-3 mr-2"><i class="fa fa-save"></i>
                                Simpan</button>
                            <a href="/guru" class="btn btn-secondary float-right mb-3 mr-2"><i
                                    class="fa fa-arrow-left"></i>
                                Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
