@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h4>Edit Data Kelas</h4>
                            </div>
                        </div>
                    </div>
                    <form action="/kelas/{{ $kelas->id }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label for="kelas">Kelas <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="kelas"
                                    value="{{ old('kelas', $kelas->kelas) }}">
                                @error('kelas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nis">Wali Kelas<span style="color: red">*</span></label>
                                <select class="form-control" name="guru_id" id="guru_id">
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}"
                                            @if ($kelas->guru_id == $guru->id) selected @endif>
                                            {{ $guru->nm_guru }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('guru_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success float-right mb-3 mr-2"><i class="fa fa-save"></i>
                                Simpan</button>
                            <a href="/kelas" class="btn btn-secondary float-right mb-3 mr-2"><i
                                    class="fa fa-arrow-left"></i>
                                Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
