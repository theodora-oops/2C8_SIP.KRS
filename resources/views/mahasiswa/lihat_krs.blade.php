<!DOCTYPE html>
<html>
<head>
<title>Lihat KRS</title>

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
background:#f3f3f3;
padding:20px;
}

.logo{
font-size:32px;
font-weight:bold;
margin-bottom:30px;
}

/* MENU FIX */
.menu{
display:block;
padding:15px;
margin-bottom:15px;
border-radius:20px;
background:#ddd;
font-size:18px;
text-decoration:none;
cursor:pointer;
text-decoration:none;
color:black;
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
background: url('{{ asset('bg.jpeg') }}');
background-size:cover;
background-position:center;
}

/* HEADER */
.header{
background:#7a4a12;
color:white;
padding:15px 30px;
display:flex;
justify-content:space-between;
align-items:center;
font-size:24px;
}

.header-title{
font-size:24px;
font-weight:bold;
}

.profile{
display:flex;
flex-direction:column;
align-items:center;
color:white;
}

.profile img{
width:45px;
height:45px;
border-radius:50%;
object-fit:cover;
}

.profile span{
font-size:13px;
margin-top:3px;
}

/* BOX */
.box{
width:70%;
margin:30px auto;
background:#efefef;
border-radius:25px;
padding:25px;
}

/* TABLE */
table{
width:80%;
margin:auto;
border-collapse:collapse;
}

th, td{
border:2px solid black;
padding:8px;
text-align:center;
}

th{
background:#ddd;
}

/* BOTTOM */
.bottom{
margin-top:30px;
display:flex;
justify-content:space-between;
width:80%;
margin-left:auto;
margin-right:auto;
align-items:center;
}

.box-sks{
border:2px solid black;
padding:5px 15px;
background:white;
display:inline-block;
}

/* BUTTON */
.btn{
margin-top:10px;
padding:10px 20px;
background:#5e97da;
border:2px solid black;
cursor:pointer;
}
</style>
</head>

<body>

<div class="wrapper">

<!-- SIDEBAR -->
<div class="sidebar">
<div class="logo">SIP.KRS</div>

<<a href="/mahasiswa/dashboard"><div class="menu">🏠 Beranda</div></a>

<a href="/mahasiswa/krs"><div class="menu active">📄 Isi KRS</div></a>

<a href="/mahasiswa/lihat-krs"><div class="menu">📄 Lihat KRS</div></a>

<a href="/mahasiswa/khs"><div class="menu">📄 Lihat KHS</div></a>

<a href="/login"><div class="menu">↪ Logout</div></a>
</div>

<!-- CONTENT -->
<div class="content">

<!-- HEADER -->
<div class="header">
    <div class="header-title">
        Selamat Datang, Enif Azzahra 👋
    </div>
<div class="profile">
<img src="{{ asset('user.webp') }}">
<span>Enif</span>
</div>
</div>

<div class="box">

<!-- SEMESTER -->
<div style="margin-bottom:15px; font-size:18px;">
Semester :
<select>
@for ($i = 1; $i <= 8; $i++)
<option {{ $semester == $i ? 'selected' : '' }}>{{ $i }}</option>
@endfor
</select>
</div>

<!-- BIODATA -->
<div style="margin-bottom:15px; font-size:18px;">
Nama : Enif Azzahra <br>
IP Semester Lalu : 3.85
</div>

<!-- TABLE -->
<table>
<tr>
<th>Kode</th>
<th>Mata Kuliah</th>
<th>SKS</th>
<th>Status</th>
</tr>

@foreach($krs as $m)
<tr>
<td>{{ $m['kode'] }}</td>
<td>{{ $m['nama_mk'] }}</td>
<td>{{ $m['sks'] }}</td>
<td>✔️ Diambil</td>
</tr>
@endforeach

</table>

<!-- BOTTOM -->
<div class="bottom">

<div>
Total SKS :
<span class="box-sks">{{ $total_sks }}/24</span>
</div>

<button class="btn">📄 Cetak PDF</button>

</div>

</div>
</div>
</div>

</body>
</html>