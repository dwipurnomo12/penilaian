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
            <h2>Laporan Hasil Absensi Siswa</h2>
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
                            <th class="text-left">Tahun Ajaran</th>
                            <th class="text-left">Nama Siswa</th>
                            <th class="text-left">Sakit</th>
                            <th class="text-left">Izin</th>
                            <th class="text-left">Tanpa Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensis as $absensi)
                            <tr>
                                <td class="text-left">{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $absensi->tahun_ajaran->tahun_ajaran }} -
                                    {{ $absensi->tahun_ajaran->semester }}</td>
                                <td class="text-left">{{ $absensi->siswa->nm_siswa }}</td>
                                <td class="text-left">{{ $absensi->sakit }} Hari</td>
                                <td class="text-left">{{ $absensi->izin }} Hari</td>
                                <td class="text-left">{{ $absensi->tanpa_keterangan }} Hari</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
