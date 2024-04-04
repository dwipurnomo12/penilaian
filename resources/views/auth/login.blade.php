@extends('layouts.app')

@section('login')
    <div class="col-md-4 mx-auto mt-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Login Sistem</h4>
                <p class="card-category text-center">
                    SISTEM INFORMASI PENGELOLAAN DATA NILAI SISWA
                </p>
                <p class="card-category text-center">
                    SMP NEGERI 1 NGGAHA ORI ANGU
                </p>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nop">Username <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="username">
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nop">Password <span style="color: red">*</span></label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <span class="form-check-sign">Simpan info login</span>
                            </label>
                        </div>
                    </div>

                    <div class="d-grid mx-auto">
                        <button class="btn btn-primary btn-block" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
