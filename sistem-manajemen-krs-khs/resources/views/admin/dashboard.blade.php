<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SIP.KRS</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <!-- SIDEBAR -->
    <div class="flex">
        <aside class="w-64 bg-slate-800 text-white min-h-screen p-5">
            <h2 class="text-2xl font-bold mb-8 text-center">SIP.KRS</h2>

            <nav class="space-y-2">
                <a href="/admin/dashboard" class="block px-4 py-2 rounded hover:bg-slate-700">Dashboard</a>
                <a href="/admin/pengguna" class="block px-4 py-2 rounded hover:bg-slate-700">Kelola Pengguna</a>
                <a href="/admin/matkul" class="block px-4 py-2 rounded hover:bg-slate-700">Kelola Matkul</a>
                <a href="/admin/semester" class="block px-4 py-2 rounded hover:bg-slate-700">Kelola Semester</a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1">

            <!-- NAVBAR -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <div>
                    <h1 class="text-xl font-semibold">Dashboard Admin</h1>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="font-medium">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                    </div>

                    <img src="https://i.pravatar.cc/40" class="w-10 h-10 rounded-full" alt="profile">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- CONTENT -->
            <main class="p-6">

                <!-- WELCOME -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold">Selamat Datang 👋</h2>
                    <p class="text-gray-600">Sistem Informasi Akademik (KRS dan KHS)</p>
                </div>

                <!-- STATS -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-blue-500 text-white p-5 rounded-xl shadow">
                        <h3 class="text-3xl font-bold">120</h3>
                        <p>Mahasiswa</p>
                    </div>

                    <div class="bg-green-500 text-white p-5 rounded-xl shadow">
                        <h3 class="text-3xl font-bold">15</h3>
                        <p>Dosen</p>
                    </div>

                    <div class="bg-yellow-400 text-black p-5 rounded-xl shadow">
                        <h3 class="text-3xl font-bold">28</h3>
                        <p>Mata Kuliah</p>
                    </div>
                </div>

                <!-- INFO CARD -->
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-semibold mb-2">Informasi Sistem</h3>
                    <p class="text-gray-600">
                        Ini adalah dashboard admin SIP.KRS. Gunakan menu di sidebar untuk mengelola data pengguna, mata
                        kuliah, dan semester.
                    </p>
                </div>

            </main>

        </div>
    </div>

</body>

</html>
