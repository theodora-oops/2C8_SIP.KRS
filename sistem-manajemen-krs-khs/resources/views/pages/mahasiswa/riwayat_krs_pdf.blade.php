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
            margin: 5px 0;
            font-size: 12px;
        }


        .info {
            width: 100%;
            margin-bottom: 20px;
        }

        .info td {
            padding: 4px;
        }


        .semester {
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 8px;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }


        table th {
            background: #e5e7eb;
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }


        table td {
            border: 1px solid #000;
            padding: 7px;
        }


        table td.center {
            text-align: center;
        }


        .total {
            text-align: right;
            font-weight: bold;
            margin-bottom: 20px;
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

    <h2>RIWAYAT KARTU RENCANA STUDI (KRS)</h2>

    <p>
        Sistem Informasi Akademik
    </p>

</div>



<table class="info">

    <tr>
        <td width="18%">
            <strong>Nama</strong>
        </td>

        <td width="2%">:</td>

        <td>
            {{ $mahasiswa->nama }}
        </td>
    </tr>


    <tr>

        <td>
            <strong>NIM</strong>
        </td>

        <td>:</td>

        <td>
            {{ $mahasiswa->nomor_induk }}
        </td>

    </tr>


    @if(isset($mahasiswa->kelas))

    <tr>

        <td>
            <strong>Kelas</strong>
        </td>

        <td>:</td>

        <td>
            {{ $mahasiswa->kelas }}
        </td>

    </tr>

    @endif


</table>




@foreach($krs as $semester => $items)


<div class="semester">
    {{ $semester }}
</div>



<table>

    <thead>

        <tr>

            <th width="15%">
                Kode MK
            </th>

            <th width="50%">
                Mata Kuliah
            </th>

            <th width="15%">
                SKS
            </th>

        </tr>

    </thead>



    <tbody>


    @php
        $totalSks = 0;
    @endphp



    @foreach($items as $k)


        <tr>

            <td class="center">
                {{ $k->matkul->kode_mk }}
            </td>


            <td>
                {{ $k->matkul->nama_mk }}
            </td>


            <td class="center">
                {{ $k->matkul->sks }}
            </td>


        </tr>


        @php
            $totalSks += $k->matkul->sks;
        @endphp



    @endforeach



    </tbody>


</table>



<div class="total">

    Total SKS:
    {{ $totalSks }}

</div>



@endforeach





<div class="footer">

    Dicetak pada:
    {{ \Carbon\Carbon::now()->format('d-m-Y') }}

</div>



</body>

</html>