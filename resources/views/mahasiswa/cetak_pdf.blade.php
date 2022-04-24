<!DOCTYPE html>
<html>


<head>
    <title>KARTU HASIL STUDI (KHS)</title>

</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 15pt;
        }
    </style>
    <center>
        <h3>LAPORAN KARTU HASIL STUDI (KHS)</h3>
        <h5>JURUSAN TEKNOLOGI INFORMASIPOLITEKNIK NEGERI MALANG</h5>
    </center>

    <br><br>
        <ul class="" style="list-style-type: none;">
            <li class=""><b>Nama: </b>{{$daftar -> mahasiswa -> nama}}</li>
            <li class=""><b>Nim: </b>{{$daftar->mahasiswa->nim}}</li>
            <li class=""><b>Kelas: </b>{{$daftar->mahasiswa->kelas->nama_kelas}}</li>
        </ul>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Nilai</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($daftar as $d)
            <tr>
                <td>
                    {{$d->matakuliah->nama_matkul}}
                </td>
                <td>
                    {{$d->matakuliah->sks}}
                </td>
                <td>
                    {{$d->matakuliah->semester}}
                </td>
                <td>
                    {{$d->nilai}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br><br>
    <div style="text-align: right;">
        <strong>Dosen Pembina Akademik </strong>
        <br><br><br>
        <p>Nama</p>
    </div>
</body>

</html>