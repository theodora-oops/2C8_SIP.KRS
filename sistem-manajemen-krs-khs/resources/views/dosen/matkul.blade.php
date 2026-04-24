<!DOCTYPE html>
<html>
<head>
    <title>Mata Kuliah Diampu</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #2c3e50;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px;
            text-decoration: none;
            padding-left: 20px;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        /* CONTENT */
        .content {
            margin-left: 220px;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .matkul-box {
            background: #4facfe;
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            background: white;
            color: #4facfe;
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn:hover {
            background: #e6f3ff;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>DOSEN</h2>

    <a href="/dosen/dashboard">Dashboard</a>
    <a href="/dosen/matkul">Mata Kuliah Diampu</a>
    <a href="/dosen/kelas/pemrograman-web">Input Nilai</a>
</div>

<!-- CONTENT -->
<div class="content">

    <h2>Mata Kuliah Diampu</h2>

    <div class="card">

        <div class="matkul-box">
            <span>Pemrograman Web</span>
            <a class="btn" href="/dosen/kelas/pemrograman-web">Lihat Kelas</a>
        </div>

        <div class="matkul-box">
            <span>Basis Data</span>
            <a class="btn" href="/dosen/kelas/basis-data">Lihat Kelas</a>
        </div>

        <div class="matkul-box">
            <span>Dasar Rekayasa Perangkat Lunak</span>
            <a class="btn" href="/dosen/kelas/rpl">Lihat Kelas</a>
        </div>

    </div>

</div>

</body>
</html>