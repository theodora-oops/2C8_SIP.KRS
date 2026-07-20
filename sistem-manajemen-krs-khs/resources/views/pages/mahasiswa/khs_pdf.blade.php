<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
        }

        .header p {
            margin: 4px 0;
            font-size: 12px;
        }

        .info {
            width: 100%;
            margin-bottom: 20px;
        }

        .info td {
            padding: 4px;
        }

        table.khs {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 18px;
        }

        table.khs th,
        table.khs td {
            border: 1px solid #000;
            padding: 7px;
        }

        table.khs th {
            background: #e5e7eb;
            text-align: center;
        }

        table.khs td {
            text-align: center;
        }

        table.khs td.nama {
            text-align: left;
        }

        .semester {
            font-size: 14px;
            font-weight: bold;
            margin-top: 18px;
            margin-bottom: 8px;
        }

        .rekap {
            margin-top: 5px;
            text-align: right;
            font-weight: bold;
        }

        .ipk {
            margin-top: 25px;
            text-align: right;
            font-size: 15px;
            font-weight: bold;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>KARTU HASIL STUDI (KHS)</h2>
        <p>Sistem Informasi Akademik</p>
    </div>

    <table class="info">
        <tr>
            <td width="18%"><strong>Nama</strong></td>
            <td width="2%">:</td>
            <td>{{ $mahasiswa->nama }}</td>
        </tr>

        <tr>
            <td><strong>NIM</strong></td>
            <td>:</td>
            <td>{{ $mahasiswa->nomor_induk }}</td>
        </tr>

        @if(isset($mahasiswa->kelas))
        <tr>
            <td><strong>Kelas</strong></td>
            <td>:</td>
            <td>{{ $mahasiswa->kelas }}</td>
        </tr>
        @endif
    </table>

    @foreach($hasil as $semester => $item)

    <div class="semester">
        {{ $semester }}
    </div>

    <table class="khs">

        <thead>
            <tr>
                <th width="15%">Kode MK</th>
                <th width="45%">Mata Kuliah</th>
                <th width="10%">SKS</th>
                <th width="15%">Nilai</th>
            </tr>
        </thead>

        <tbody>

            @foreach($item['data'] as $k)

            <tr>
                <td>{{ $k->matkul->kode_mk }}</td>

                <td class="nama">
                    {{ $k->matkul->nama_mk }}
                </td>

                <td>{{ $k->matkul->sks }}</td>

                <td>
                    {{ $k->nilai?->nilai ?? '-' }}
                </td>
            </tr>

            @endforeach

        </tbody>

    </table>

    <div class="rekap">
        Total SKS : {{ $item['total_sks'] }}
        &nbsp;&nbsp;&nbsp;&nbsp;
        IPS : {{ $item['ips'] }}
    </div>

    @endforeach

    <div class="ipk">
        IPK : {{ $ipk }}
    </div>

    <div class="footer">
        Dicetak pada : {{ \Carbon\Carbon::now()->format('d-m-Y') }}
    </div>

</body>

</html>