<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP.KRS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

<div x-data="{ openSidebar: false }" class="min-h-screen">

    <!-- MOBILE TOPBAR -->
    <div class="md:hidden bg-slate-900 text-white flex items-center justify-between p-4">

        <h1 class="text-xl font-bold">
            SIP.KRS
        </h1>

        <!-- BUTTON HAMBURGER -->
        <button @click="openSidebar = true" class="text-2xl">
            ☰
        </button>
    </div>

    <div class="flex min-h-screen">

        <!-- OVERLAY MOBILE -->
        <div
            x-show="openSidebar"
            @click="openSidebar = false"
            class="fixed inset-0 bg-black/50 z-40 md:hidden"
            x-transition>
        </div>

        <!-- SIDEBAR -->
        <aside
            class="fixed md:static top-0 left-0 z-50 w-64 bg-slate-900 text-gray-200 p-5 flex flex-col min-h-screen
            transform transition-transform duration-300
            -translate-x-full md:translate-x-0"
            :class="{ 'translate-x-0': openSidebar }">

            <!-- HEADER MOBILE -->
            <div class="flex items-center justify-between md:block">

                <h2 class="text-2xl font-bold mb-0 md:mb-10 text-white tracking-wide">
                    SIP.KRS
                </h2>

                <!-- CLOSE BUTTON -->
                <button
                    @click="openSidebar = false"
                    class="md:hidden text-2xl">
                    ✕
                </button>

            </div>

            <!-- MENU -->
            <nav class="space-y-2 flex-1 mt-8 md:mt-0">

                <!-- Dashboard -->
                <a href="/admin/dashboard"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->is('admin/dashboard') ? 'bg-slate-700 text-white' : 'hover:bg-slate-800' }}">

                    <span>Dashboard</span>
                </a>

                <!-- Pengguna -->
                <a href="/admin/pengguna"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->is('admin/pengguna*') ? 'bg-slate-700 text-white' : 'hover:bg-slate-800' }}">

                    <span>Kelola Pengguna</span>
                </a>

                <!-- Matkul -->
                <a href="/admin/matkul"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->is('admin/matkul*') ? 'bg-slate-700 text-white' : 'hover:bg-slate-800' }}">

                    <span>Kelola Matkul</span>
                </a>

                <!-- Semester -->
                <a href="/admin/semester"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->is('admin/semester*') ? 'bg-slate-700 text-white' : 'hover:bg-slate-800' }}">

                    <span>Kelola Semester</span>
                </a>

            </nav>

            <!-- FOOTER -->
            <div class="text-sm text-gray-400 text-center mt-6">
                © {{ date('Y') }} SIP.KRS
            </div>

        </aside>

        <!-- MAIN -->
        <div class="flex-1 flex flex-col w-full">

            <!-- NAVBAR -->
            <x-navbar :title="View::yieldContent('title')" />

            <!-- CONTENT -->
            <main class="p-4 md:p-6">
                @yield('content')
            </main>

        </div>

    </div>

</div>

<!-- ALPINE JS -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>