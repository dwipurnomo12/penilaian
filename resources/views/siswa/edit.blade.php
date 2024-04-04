@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h4>Edit Data Siswa</h4>
                            </div>
                        </div>
                    </div>
                    <form action="/siswa/{{ $siswa->id }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <label for="nm_siswa">Nama Lengkap <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="nm_siswa"
                                            value="{{ old('nm_siswa', $siswa->nm_siswa) }}">
                                        @error('nm_siswa')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nis">Nomor Induk Siswa (NIS)<span
                                                style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="nis"
                                            value="{{ old('nis', $siswa->nis) }}">
                                        @error('nis')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="text">Jenis Kelamin <span style="color: red">*</span></label>
                                        <select class="form-control" name="j_kelamin" id="j_kelamin">
                                            @foreach (['laki-laki', 'perempuan'] as $j_kelamin)
                                                <option value="{{ $j_kelamin }}"
                                                    @if ($j_kelamin == $siswa->j_kelamin) selected @endif>
                                                    {{ ucfirst($j_kelamin) }}</option>
                                            @endforeach
                                        </select>
                                        @error('j_kelamin')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nis">Pilih Kelas<span style="color: red">*</span></label>
                                        <select class="form-control" name="kelas_id" id="kelas_id">
                                            @foreach ($kelases as $kelas)
                                                <option value="{{ $kelas->id }}"
                                                    @if ($siswa->kelas_id == $kelas->id) selected @endif>
                                                    {{ $kelas->kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp">Nomor HP<span style="color: red">*</span></label>
                                        <input type="number" class="form-control" name="no_hp"
                                            value="{{ old('no_hp', $siswa->no_hp) }}">
                                        @error('no_hp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat">Alamat <span style="color: red">*</span></label>
                                        <textarea class="form-control" name="alamat" rows="5" value="{{ old('alamat') }}">{{ old('alamar', $siswa->alamat) }}</textarea>
                                        @error('alamat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body p-4">
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
