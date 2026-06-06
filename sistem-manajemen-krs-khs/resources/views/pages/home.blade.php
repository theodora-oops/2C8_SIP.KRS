<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP.KRS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        html{
            scroll-behavior:smooth;
        }

        body{
            background:#f8fafc;
            font-family:'Segoe UI',sans-serif;
        }

        /* NAVBAR */

        .navbar-custom{
            background:#0f172a;
        }

        .navbar-brand{
            font-size:1.8rem;
            font-weight:700;
        }

        .nav-link{
            color:white !important;
        }

        /* HERO */

        .hero{
            background:linear-gradient(135deg,#eff6ff,#dbeafe);
            border-radius:25px;
            padding:80px 30px;
            text-align:center;
            margin-top:40px;
        }

        .hero-icon{
            width:90px;
            height:90px;
            background:white;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            margin:auto;
            color:#2563eb;
            font-size:40px;
            box-shadow:0 4px 12px rgba(0,0,0,.1);
        }

        .hero h1{
            font-weight:700;
            margin-top:25px;
            color:#0f172a;
        }

        .hero p{
            color:#64748b;
            font-size:1.1rem;
        }

        /* CARD MENU */

        .menu-card{
            border:none;
            border-radius:20px;
            transition:.3s;
            height:100%;
        }

        .menu-card:hover{
            transform:translateY(-8px);
        }

        .card-blue{
            background:#eff6ff;
        }

        .card-green{
            background:#f0fdf4;
        }

        .card-purple{
            background:#faf5ff;
        }

        .menu-icon{
            width:70px;
            height:70px;
            background:white;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:28px;
            margin-bottom:20px;
        }

        /* SECTION */

        .section-card{
            border:none;
            border-radius:20px;
            box-shadow:0 4px 12px rgba(0,0,0,.08);
        }

        .section-title{
            font-weight:700;
            color:#0f172a;
        }

        /* CONTACT */

        .contact-icon{
            font-size:2rem;
            margin-bottom:15px;
        }

        /* FOOTER */

        footer{
            background:#0f172a;
            color:white;
            margin-top:60px;
            padding:25px;
        }

    </style>

</head>
<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">

    <div class="container">

        <a class="navbar-brand" href="#home">
            <i class="fa-solid fa-graduation-cap"></i>
            SIP.KRS
        </a>

        <button class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>

                <li class="nav-item ms-lg-3">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        Login
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- HERO -->

<div class="container" id="home">

    <div class="hero shadow-sm">

        <div class="hero-icon">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>

        <h1>Selamat Datang di SIP.KRS</h1>

        <p>
            Sistem Informasi Akademik untuk pengelolaan
            KRS dan KHS secara mudah, cepat, dan terintegrasi.
        </p>

        <div class="mt-4">

            <a href="#" class="btn btn-primary px-4 py-2">
                <i class="fa-solid fa-clipboard-list me-2"></i>
                KRS
            </a>

            <a href="#" class="btn btn-outline-primary px-4 py-2 ms-2">
                <i class="fa-solid fa-file-lines me-2"></i>
                KHS
            </a>

        </div>

    </div>

</div>

<!-- MENU -->

<div class="container my-5">

    <div class="row g-4">

        <div class="col-md-4">

            <div class="card menu-card card-blue p-4 shadow-sm">

                <div class="menu-icon text-primary">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>

                <h4>KRS</h4>

                <p class="text-muted">
                    Pengisian dan pengelolaan Kartu Rencana Studi mahasiswa.
                </p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card menu-card card-green p-4 shadow-sm">

                <div class="menu-icon text-success">
                    <i class="fa-solid fa-file-lines"></i>
                </div>

                <h4>KHS</h4>

                <p class="text-muted">
                    Monitoring hasil studi dan nilai akademik mahasiswa.
                </p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card menu-card card-purple p-4 shadow-sm">

                <div class="menu-icon text-secondary">
                    <i class="fa-solid fa-book"></i>
                </div>

                <h4>Mata Kuliah</h4>

                <p class="text-muted">
                    Informasi dan pengelolaan data mata kuliah.
                </p>

            </div>

        </div>

    </div>

</div>

<!-- INFORMASI SISTEM -->

<div class="container">

    <div class="card section-card">

        <div class="card-body p-4">

            <h4 class="section-title mb-4">
                <i class="fa-solid fa-circle-info text-primary"></i>
                Informasi Sistem
            </h4>

            <ul class="list-group list-group-flush">

                <li class="list-group-item">
                    Pengelolaan Kartu Rencana Studi (KRS) secara online.
                </li>

                <li class="list-group-item">
                    KHS dapat diakses untuk melihat hasil studi setiap semester.
                </li>

                <li class="list-group-item">
                    Meningkatkan efisiensi pengelolaan data akademik.
                </li>

            </ul>

        </div>

    </div>

</div>

<!-- ABOUT -->

<div class="container my-5" id="about">

    <div class="card section-card">

        <div class="card-body p-5">

            <h2 class="section-title mb-4">
                Tentang SIP.KRS
            </h2>

            <p class="text-muted fs-5">
                SIP.KRS merupakan Sistem Informasi Akademik yang
                membantu mahasiswa, dosen, dan administrator dalam
                mengelola KRS dan KHS secara efektif serta terintegrasi.
            </p>

            <p class="text-muted mb-0">
                Sistem ini dikembangkan untuk mempermudah pengelolaan
                data akademik dan meningkatkan efisiensi layanan kampus.
            </p>

        </div>

    </div>

</div>

<!-- CONTACT -->

<div class="container my-5" id="contact">

    <div class="card section-card">

        <div class="card-body p-5">

            <h2 class="section-title mb-5 text-center">
                Hubungi Kami
            </h2>

            <div class="row text-center">

                <!-- EMAIL -->
                <div class="col-md-4 mb-4">

                    <a href="mailto:admin@sipkrs.ac.id"
                       class="text-decoration-none text-dark">

                        <i class="fa-solid fa-envelope text-primary contact-icon"></i>

                        <h5>Email</h5>

                        <p class="text-muted">
                            admin@sipkrs.ac.id
                        </p>

                    </a>

                </div>

                <!-- WHATSAPP -->
                <div class="col-md-4 mb-4">

                    <a href="https://wa.me/6281277297578?text=Halo%20Admin%20SIP.KRS"
                       target="_blank"
                       class="text-decoration-none text-dark">

                        <i class="fa-brands fa-whatsapp text-success contact-icon"></i>

                        <h5>WhatsApp</h5>

                        <p class="text-muted">
                            0812-7729-7578
                        </p>

                    </a>

                </div>

                <!-- ALAMAT -->
                <div class="col-md-4 mb-4">

                    <div class="col-md-4 mb-4">

                        <a href="https://maps.google.com/?q=Politeknik+Negeri+Batam"
                        target="_blank"
                        class="text-decoration-none text-dark">

                            <i class="fa-solid fa-location-dot text-danger contact-icon"></i>

                            <h5>Alamat</h5>

                            <p class="text-muted">
                                Politeknik Negeri Batam<br>
                            </p>

                        </a>

</div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- FOOTER -->

<footer class="text-center">

    © {{ date('Y') }} SIP.KRS. All Rights Reserved.

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
