<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Nilai </title>
</head>


<style>
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        border: 1px solid black;
        padding: 20px;
        margin: 20px;
    }

    .header {
        text-align: center;
    }

    .detail {
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .footer {
        font-weight: bold;
    }

    <style>.container {
        text-align: center;
        margin: auto;
        position: relative;
    }

    .table-container {
        position: relative;
    }


    .column {
        text-align: center;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    table {
        margin: auto;
        width: 100%;
        margin-bottom: 20px;
    }

    tr {
        text-align: left;
    }

    table,
    th,
    td {
        border-collapse: collapse;
        border: 1px solid black;
    }

    th,
    td {
        padding: 5px;
    }

    th {
        background-color: gainsboro;
    }
</style>

<body>
    <div class="container">

        <div class="header">
            <h2>Laporan Hasil Belajar Siswa</h2>
        </div>

        <div class="card-body">
            @if (session()->has('success'))
                <div class="card bg-success text-white">
                    <div class="card-body">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="column">
                    @foreach ($penilaians as $nilai)
                        <b>Kelas : {{ $kelas }}</b> <br>
                        <b>Wali Kelas : {{ $guru }}</b> <br>
                        <b>Tahun Ajaran : {{ $nilai->tahun_ajaran->tahun_ajaran }} -
                            {{ $nilai->tahun_ajaran->semester }}</b><br>
                    @break
                @endforeach
            </div>
            <div class="table-responsive p-2">
                <table id="table_id" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Siswa</th>
                            <th>Mata Pelajaran</th>
                            <th>Jenis Nilai</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $current_student = null; @endphp
                        @foreach ($penilaians as $key => $penilaian)
                            @if ($current_student != $penilaian->siswa->nm_siswa)
                                @php $current_student = $penilaian->siswa->nm_siswa; @endphp
                                <tr>
                                    <td
                                        rowspan="{{ $penilaians->where('siswa_id', $penilaian->siswa_id)->count() }}">
                                        {{ $penilaian->siswa->nm_siswa }}</td>
                                    <td>{{ $penilaian->mata_pelajaran->mata_pelajaran }}</td>
                                    <td>{{ $penilaian->jenis_nilai->jenis_nilai }}</td>
                                    <td>{{ $penilaian->nilai }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{ $penilaian->mata_pelajaran->mata_pelajaran }}</td>
                                    <td>{{ $penilaian->jenis_nilai->jenis_nilai }}</td>
                                    <td>{{ $penilaian->nilai }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
