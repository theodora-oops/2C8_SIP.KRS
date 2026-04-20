<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kursus Saya</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: #e9e9e9;
}

/* CONTAINER */
.page {
    width: 760px;
    height: 404px;
    margin: 10px auto;
    display: flex;
    background: #fff;
}

/* SIDEBAR */
.sidebar {
    width: 170px;
    background: #e6e6e6;
    padding-top: 10px;
}

.brand {
    text-align: center;
    font-weight: 800;
    font-size: 20px;
    margin-bottom: 15px;
}

.menu {
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding: 0 10px;
}

.menu-item {
    height: 56px;
    background: #dcdcdc;
    border-radius: 20px;
    display: flex;
    align-items: center;
    padding-left: 15px;
    font-size: 16px;
    gap: 10px;
}

.menu-item.active {
    background: #b7cbe8;
}

/* MAIN */
.main {
    flex: 1;
    background: url('{{ asset('images/bg-kampus.png') }}') center/cover no-repeat;
}

/* HEADER */
.header {
    height: 60px;
    background: #6d88a9;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

.header h2 {
    color: white;
    font-size: 18px;
}

/* PROFILE */
.profile {
    text-align: center;
}

.circle {
    width: 38px;
    height: 38px;
    background: white;
    border-radius: 50%;
    border: 2px solid black;
}

.profile span {
    font-size: 11px;
    color: white;
}

/* CARD */
.card {
    width: 500px;
    height: 240px;
    background: #f3f3f3;
    margin: 40px auto;
    border-radius: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* COURSE BOX */
.courses {
    display: flex;
    gap: 20px;
}

.box {
    width: 140px;
    height: 100px;
    background: #c6d6ee;
    border-radius: 20px;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.kode {
    font-weight: 700;
}

.nama {
    font-size: 14px;
    font-weight: 600;
    white-space: pre-line;
}
</style>

</head>
<body>

<div class="page">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="brand">SIP.KRS</div>

        <div class="menu">
            <div class="menu-item">🏠 Beranda</div>
            <div class="menu-item active">📄 Kursus Saya</div>
            <div class="menu-item">📄 Input Nilai</div>
            <div class="menu-item">➡ Keluar</div>
        </div>
    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- HEADER -->
        <div class="header">
            <h2>Selamat Datang, {{ $dosen['nama'] }} 👋</h2>

            <div class="profile">
                <div class="circle"></div>
                <span>{{ $dosen['nama_panggilan'] }}</span>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="card">
            <div class="courses">
                @foreach($courses as $c)
                    <div class="box">
                        <div class="kode">{{ $c['kode'] }}</div>
                        <div class="nama">{{ $c['nama'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</div>

</body>
</html>