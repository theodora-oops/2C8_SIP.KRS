<!DOCTYPE html>
<html>
<head>
    <title>Mahasiswa - {{ $matkul }}</title>

    <style>
        body { font-family:Arial; background:#f4f6f9; margin:0; }

        .content { margin-left:220px; padding:20px; }

        table {
            width:100%;
            border-collapse: collapse;
            background:white;
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
            padding:5px;
            width:70px;
        }

        button {
            padding:6px 10px;
            background:#28a745;
            color:white;
            border:none;
            border-radius:5px;
        }

        .back {
            display:inline-block;
            margin-bottom:10px;
            text-decoration:none;
            color:#4facfe;
        }
    </style>
</head>

<body>

<div class="content">

    <a class="back" href="/dosen/matkul">← Kembali ke Mata Kuliah</a>

    <h2>Mahasiswa - {{ $matkul }}</h2>

    <table>
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>

        <tr>
            <td>Andi</td>
            <td>12345</td>
            <td><input type="text"></td>
            <td><button>Simpan</button></td>
        </tr>

        <tr>
            <td>Budi</td>
            <td>67890</td>
            <td><input type="text"></td>
            <td><button>Simpan</button></td>
        </tr>

    </table>

</div>

</body>
</html>