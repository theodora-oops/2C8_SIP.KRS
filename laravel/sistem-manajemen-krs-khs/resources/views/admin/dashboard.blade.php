<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - SIP.KRS</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #343a40;
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
            background: #495057;
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
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .box {
            background: #4facfe;
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .box h3 {
            margin: 0;
            font-size: 24px;
        }

        .topbar {
            background: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>ADMIN</h2>

    <a href="/admin/dashboard">Dashboard</a>
    <a href="/admin/dosen">Kelola Dosen</a>
    <a href="/admin/mahasiswa">Kelola Mahasiswa</a>
    <a href="/admin/matkul">Kelola Matkul</a>
</div>

<!-- CONTENT -->
<div class="content">

    <div class="topbar">
        <h3>Dashboard Admin</h3>
        <p>Selamat datang di sistem SIP.KRS</p>
    </div>

    <div class="grid">

        <div class="box">
            <h3>120</h3>
            <p>Mahasiswa</p>
        </div>

        <div class="box" style="background:#28a745;">
            <h3>15</h3>
            <p>Dosen</p>
        </div>

        <div class="box" style="background:#ffc107; color:black;">
            <h3>30</h3>
            <p>Mata Kuliah</p>
        </div>

    </div>

    <div class="card">
        <h3>Informasi Sistem</h3>
        <p>Ini adalah dashboard admin SIP.KRS. Gunakan menu di sebelah kiri untuk mengelola data.</p>
    </div>

</div>

</body>
</html>