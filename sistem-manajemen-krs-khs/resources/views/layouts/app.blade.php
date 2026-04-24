<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP.KRS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-800 text-white min-h-screen p-5">
        <h2 class="text-2xl font-bold mb-8 text-center">SIP.KRS</h2>

        <nav class="space-y-2">
            <a href="/admin/dashboard" class="block px-4 py-2 rounded hover:bg-slate-700">Dashboard</a>
            <a href="/admin/pengguna" class="block px-4 py-2 rounded bg-slate-700">Kelola Pengguna</a>
            <a href="/admin/matkul" class="block px-4 py-2 rounded hover:bg-slate-700">Kelola Matkul</a>
            <a href="/admin/semester" class="block px-4 py-2 rounded hover:bg-slate-700">Kelola Semester</a>
        </nav>
    </aside>

    <!-- MAIN -->
    <div class="flex-1">

        <!-- NAVBAR -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">@yield('title')</h1>

            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="p-6">
            @yield('content')
        </main>

    </div>
</div>
</body>
</html>