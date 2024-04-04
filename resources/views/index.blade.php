@extends('layouts.main')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $kelases }}</h2>
                        <div class="m-b-5">Jumlah Kelas</div><i class="fa fa-solid fa-landmark widget-stat-icon pt-3"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $siswas }}</h2>
                        <div class="m-b-5">Jumlah Siswa</div><i class="fa fa-solid fa-users widget-stat-icon pt-3"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $gurus }}</h2>
                        <div class="m-b-5">Jumlah Guru</div><i class="fa fa-solid fa-user-tie widget-stat-icon pt-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

        </div>
    </div>
@endsection
