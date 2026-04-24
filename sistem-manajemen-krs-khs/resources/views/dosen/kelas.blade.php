<!DOCTYPE html>
<html>
<head>
    <title>Kelas - {{ $matkul }}</title>

    <style>
        body { font-family:Arial; background:#f4f6f9; margin:0; }

        .content { margin-left:220px; padding:20px; }

        .card {
            background:white;
            padding:15px;
            border-radius:10px;
        }

        table {
            width:100%;
            border-collapse: collapse;
            margin-top:10px;
        }

        th, td {
            border:1px solid #ddd;
            padding:10px;
        }

        th {
            background:#4facfe;
            color:white;
        }

        input {
            width:60px;
            padding:5px;
        }

        button {
            background:#28a745;
            color:white;
            border:none;
            padding:6px 10px;
            border-radius:5px;
        }

        .back {
            display:inline-block;
            margin-bottom:10px;
            color:#4facfe;
            text-decoration:none;
        }
    </style>
</head>

<body>

<div class="content">

    <a class="back" href="/dosen/matkul">← Kembali</a>

    <h2>Kelas: {{ $matkul }}</h2>

    <div class="card">

        <table>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>

            <tr>
                <td>Yohana</td>
                <td>089</td>
                <td><input type="text"></td>
                <td><button>Simpan</button></td>
            </tr>

            <tr>
                <td>Enif</td>
                <td>088</td>
                <td><input type="text"></td>
                <td><button>Simpan</button></td>
            </tr>

        </table>

    </div>

</div>

</body>
</html>