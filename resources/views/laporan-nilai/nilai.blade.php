<!DOCTYPE html>
<html>

<head>
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Laporan Hasil Belajar Siswa</h2>
        </div>

        <div class="row">
            <div class="column">
                @foreach ($penilaians as $nilai)
                    <b>Nama Siswa : {{ $nilai->siswa->nm_siswa }} </b><br>
                    <b>NIS : {{ $nilai->siswa->nis }} </b><br>
                    <b>Tahun Ajaran : {{ $nilai->tahun_ajaran->tahun_ajaran }} -
                        {{ $nilai->tahun_ajaran->semester }}</b><br>
                @break
            @endforeach
        </div>
    </div>

    <div class="detail">
        <table id="table_id" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th>Jenis Nilai</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $current_mata_pelajaran = null;
                @endphp
                @foreach ($penilaians as $key => $penilaian)
                    @if ($current_mata_pelajaran != $penilaian->mata_pelajaran->mata_pelajaran)
                        <tr>
                            <td
                                rowspan="{{ $penilaians->where('mata_pelajaran_id', $penilaian->mata_pelajaran_id)->count() }}">
                                {{ $penilaian->mata_pelajaran->mata_pelajaran }}</td>
                            <td>{{ $penilaian->jenis_nilai->jenis_nilai }}</td>
                            <td>{{ $penilaian->nilai }}</td>
                        @else
                        </tr>
                        <tr>
                            <td>{{ $penilaian->jenis_nilai->jenis_nilai }}</td>
                            <td>{{ $penilaian->nilai }}</td>
                    @endif
                    @php
                        $current_mata_pelajaran = $penilaian->mata_pelajaran->mata_pelajaran;
                    @endphp
                @endforeach
                </tr>
            </tbody>
            <tfoot>
                <tr class="footer">
                    <td colspan="2">Total Nilai</td>
                    <td>{{ $penilaians->sum('nilai') }}</td>
                </tr>
                <tr class="footer">
                    <td colspan="2">Rata-rata</td>
                    <td>{{ $penilaians->avg('nilai') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

</body>

</html>
