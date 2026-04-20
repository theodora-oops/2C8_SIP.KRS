<!DOCTYPE html>
<html>
<head>
<title>Dashboard Mahasiswa</title>

<style>
body{
margin:0;
font-family:Arial;
}

.wrapper{
display:flex;
height:100vh;
}

/* SIDEBAR */
.sidebar{
width:230px;
background:#efefef;
padding:20px;
}

.logo{
font-size:28px;
font-weight:bold;
margin-bottom:30px;
}

.menu{
padding:15px;
margin-bottom:15px;
border-radius:20px;
background:#ddd;
font-size:18px;
cursor:pointer;
display:flex;
align-items:center;
gap:10px;
}

.menu:hover{
background:#cfcfcf;
}

.active{
background:#a8c4eb;
}

/* CONTENT */
.content{
flex:1;
background:url('{{ asset('bg.jpeg') }}');
background-size:cover;
}

/* HEADER */
.header{
background:#7a4a12;
color:white;
padding:15px 30px;
display:flex;
justify-content:space-between;
align-items:center;
font-weight:bold;
font-size:24px;
}

.profile{
text-align:center;
font-size:12px;
}

.profile img{
width:45px;
height:45px;
border-radius:50%;
}

/* CARDS */
.cards{
display:flex;
gap:20px;
margin:30px;
}

.card{
background:#efefef;
padding:20px;
border-radius:20px;
width:150px;
text-align:center;
box-shadow:0 2px 5px rgba(0,0,0,0.2);
}

.card-title{
font-size:14px;
margin-bottom:10px;
border-bottom:2px solid black;
padding-bottom:5px;
}

.card-value{
font-size:20px;
font-weight:bold;
}

/* JADWAL */
.jadwal-box{
background:#efefef;
margin:20px 30px;
padding:20px;
border-radius:20px;
width:60%;
}

.jadwal-title{
font-weight:bold;
margin-bottom:15px;
}

.jadwal-item{
background:#a8c4eb;
border-radius:15px;
padding:10px;
margin-bottom:10px;
display:flex;
}

.jam{
width:120px;
font-size:13px;
}

.detail{
flex:1;
}

.matkul{
font-weight:bold;
}

.dosen{
font-size:12px;
color:#333;
}
</style>
</head>

<body>

<div class="wrapper">

<!-- SIDEBAR -->
<div class="sidebar">
<div class="logo">SIP.KRS</div>

<a href="/mahasiswa/dashboard"><div class="menu active">🏠 Beranda</div></a>
<a href="/mahasiswa/krs"><div class="menu">📄 Isi KRS</div></a>
<a href="/mahasiswa/lihat-krs"><div class="menu">📄 Lihat KRS</div></a>
<a href="/mahasiswa/khs"><div class="menu">📄 Lihat KHS</div></a>
<a href="/login"><div class="menu">↪ Logout</div></a>

</div>

<!-- CONTENT -->
<div class="content">

<!-- HEADER -->
<div class="header">
<div>Selamat Datang, Enif Azzahra 👋</div>

<div class="profile">
<img src="{{ asset('user.webp') }}">
<div>Enif</div>
</div>
</div>

<!-- CARDS -->
<div class="cards">

<div class="card">
<div class="card-title">IPK Terakhir</div>
<div class="card-value">{{ $ipk }}</div>
</div>

<div class="card">
<div class="card-title">Semester</div>
<div class="card-value">{{ $semester }}</div>
</div>

<div class="card">
<div class="card-title">Total SKS</div>
<div class="card-value">{{ $total_sks }}</div>
</div>

</div>

<!-- JADWAL -->
<div class="jadwal-box">

<div class="jadwal-title">📅 Jadwal Kuliah Hari ini</div>

@foreach($jadwal as $j)
<div class="jadwal-item">
<div class="jam">{{ $j['jam'] }}</div>

<div class="detail">
<div class="matkul">{{ $j['matkul'] }}</div>
<div class="dosen">{{ $j['dosen'] }}</div>
</div>

</div>
@endforeach

</div>

</div>
</div>

</body>
</html>