<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Sistem KRS & KHS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans">

<section class="min-h-screen">
    <nav class="flex items-center justify-between px-10 py-5 shadow-sm bg-white">
        <div class="flex items-center gap-3">
            <div class="text-blue-700 text-4xl">🎓</div>
            <div>
                <h1 class="text-xl font-bold text-blue-900">Sistem KRS & KHS</h1>
                <p class="text-sm text-gray-500">Sistem Manajemen Akademik</p>
            </div>
        </div>

        <ul class="hidden md:flex gap-10 text-gray-700 font-medium">
            <li>Beranda</li>
            <li>KRS</li>
            <li>KHS</li>
            <li>Jadwal</li>
            <li>Informasi</li>
            <li class="text-blue-700 border-b-2 border-blue-700 pb-2">Tentang</li>
        </ul>

        <button class="bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-800">
            Login
        </button>
    </nav>

    <div class="px-10 md:px-20 py-14">
        <div class="grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-4xl md:text-5xl font-bold text-blue-950 leading-tight">
                    Tentang Sistem <br>
                    Manajemen KRS & KHS
                </h2>

                <div class="w-20 h-1 bg-blue-700 mt-6 mb-6 rounded"></div>

                <p class="text-gray-600 leading-relaxed text-lg">
                    Sistem Manajemen KRS & KHS adalah platform digital yang dirancang untuk
                    memudahkan mahasiswa dan dosen dalam mengelola Kartu Rencana Studi (KRS)
                    dan Kartu Hasil Studi (KHS) secara terintegrasi, efisien, dan akurat.
                </p>
            </div>

            <div class="flex justify-center">
                <div class="bg-blue-50 rounded-3xl p-8 w-full max-w-md">
                    <div class="bg-white shadow-lg rounded-2xl p-6">
                        <div class="h-3 w-24 bg-blue-200 rounded mb-6"></div>

                        <div class="flex items-center gap-4 bg-blue-50 p-4 rounded-xl mb-4">
                            <div class="bg-blue-700 text-white p-3 rounded-lg">📋</div>
                            <div>
                                <h3 class="font-bold text-blue-800 text-xl">KRS</h3>
                                <p class="text-gray-400 text-sm">Pengisian mata kuliah</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-blue-50 p-4 rounded-xl">
                            <div class="bg-blue-700 text-white p-3 rounded-lg">📄</div>
                            <div>
                                <h3 class="font-bold text-blue-800 text-xl">KHS</h3>
                                <p class="text-gray-400 text-sm">Hasil studi semester</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mt-14">
            <div class="bg-white rounded-2xl shadow-md p-6 flex gap-5 hover:shadow-xl transition">
                <div class="bg-blue-700 text-white w-16 h-16 rounded-full flex items-center justify-center text-3xl">
                    📋
                </div>
                <div>
                    <h3 class="text-xl font-bold text-blue-800 mb-2">Pengisian KRS</h3>
                    <p class="text-gray-600">
                        Mahasiswa dapat memilih mata kuliah sesuai semester dengan mudah dan terstruktur.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 flex gap-5 hover:shadow-xl transition">
                <div class="bg-blue-700 text-white w-16 h-16 rounded-full flex items-center justify-center text-3xl">
                    📊
                </div>
                <div>
                    <h3 class="text-xl font-bold text-blue-800 mb-2">Monitoring KHS</h3>
                    <p class="text-gray-600">
                        Lihat hasil studi setiap semester secara real-time dan terorganisir dengan baik.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 flex gap-5 hover:shadow-xl transition">
                <div class="bg-blue-700 text-white w-16 h-16 rounded-full flex items-center justify-center text-3xl">
                    🌐
                </div>
                <div>
                    <h3 class="text-xl font-bold text-blue-800 mb-2">Akses Online</h3>
                    <p class="text-gray-600">
                        Sistem dapat diakses kapan saja dan di mana saja melalui perangkat yang terhubung.
                    </p>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-10 mt-10">
            <div class="bg-blue-50 rounded-2xl p-8 flex gap-6 items-start">
                <div class="text-6xl">🎯</div>
                <div>
                    <h3 class="text-2xl font-bold text-blue-900 mb-3">Visi</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Menjadi sistem akademik digital yang modern, efisien, dan terpercaya
                        untuk mendukung kualitas pendidikan yang lebih baik.
                    </p>
                </div>
            </div>

            <div class="bg-green-50 rounded-2xl p-8 flex gap-6 items-start">
                <div class="text-6xl">🚀</div>
                <div>
                    <h3 class="text-2xl font-bold text-green-800 mb-3">Misi</h3>
                    <ul class="text-gray-700 space-y-2">
                        <li>• Meningkatkan efisiensi pengelolaan akademik</li>
                        <li>• Menyediakan informasi yang akurat dan cepat</li>
                        <li>• Mempermudah akses bagi mahasiswa dan dosen</li>
                        <li>• Mendukung transparansi akademik</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="bg-blue-800 text-white rounded-2xl mt-10 p-8 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <h3 class="text-3xl font-bold">3.250+</h3>
                <p>Mahasiswa Aktif</p>
            </div>
            <div>
                <h3 class="text-3xl font-bold">450+</h3>
                <p>Mata Kuliah</p>
            </div>
            <div>
                <h3 class="text-3xl font-bold">120+</h3>
                <p>Dosen Aktif</p>
            </div>
            <div>
                <h3 class="text-3xl font-bold">10+</h3>
                <p>Fakultas</p>
            </div>
        </div>
    </div>
</section>

</body>
</html>