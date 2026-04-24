@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Dosen</title>

    <style>
        body { margin:0; font-family:Arial; background:#f4f6f9; }

        .sidebar {
            width:220px;
            height:100vh;
            background:#2c3e50;
            position:fixed;
            padding-top:20px;
        }

        .sidebar h2 {
            color:white;
            text-align:center;
            margin-bottom:20px;
        }

        .sidebar a {
            display:block;
            color:white;
            padding:12px;
            text-decoration:none;
            padding-left:20px;
        }

        .sidebar a:hover {
            background:#34495e;
        }

        .content {
            margin-left:220px;
            padding:20px;
        }

        .card {
            background:white;
            padding:15px;
            border-radius:10px;
            margin-bottom:15px;
            box-shadow:0 2px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h2>DOSEN</h2>

    <a href="/dosen/dashboard">Dashboard</a>
    <a href="/dosen/matkul">Mata Kuliah Diampu</a>
    <a href="/dosen/kelas/pemrograman-web">Kelas / Course</a>
</div>

<div class="content">

    <h2>Dashboard Dosen</h2>

    <div class="card">
        <h3>Selamat Datang Dosen</h3>
        <p>Silakan pilih menu di sidebar untuk mengelola kelas dan nilai mahasiswa.</p>
    </div>

</div>

</body>
</html>
@endsection