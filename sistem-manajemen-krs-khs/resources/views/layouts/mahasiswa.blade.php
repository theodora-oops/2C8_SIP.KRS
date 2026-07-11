<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa - SIP.KRS</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
</style>

<div style="font-family: 'Inter', sans-serif;">

<body class="bg-gray-100 font-sans">

    <div x-data="{ openSidebar:false, sidebarOpen:true }" class="min-h-screen">

        <div class="flex min-h-screen">

            <!-- Overlay Mobile -->
            <div x-show="openSidebar" @click="openSidebar=false" class="fixed inset-0 bg-black/50 z-40 md:hidden">
            </div>

            <!-- SIDEBAR -->
            <aside class="fixed md:relative z-50 bg-white min-h-screen transition-all duration-300" :class="[
                sidebarOpen ? 'w-64' : 'w-16',
                openSidebar ? 'translate-x-0' : '-translate-x-full md:translate-x-0'
            ]">

                <!-- HEADER -->
                <div class="h-16 flex items-center justify-center text-white" style="background:#2563eb">

                    <h2 x-show="sidebarOpen" x-transition class="text-2xl font-bold">

                        SIP.KRS

                    </h2>

                </div>

                <!-- MENU -->
                <nav class="mt-4 px-2 space-y-1">

                    <!-- Dashboard -->
                    <a href="/mahasiswa/dashboard"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200
                    {{ request()->is('mahasiswa/dashboard') ? 'bg-blue-100 text-blue-700 font-bold shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10.5L12 4l7 6.5V19a1 1 0 01-1 1h-4v-5H10v5H6a1 1 0 01-1-1v-8.5z" />

                        </svg>

                        <span x-show="sidebarOpen">
                            Beranda
                        </span>

                    </a>

                    <!-- Isi KRS -->
                    <a href="/mahasiswa/krs"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200
                    {{ request()->is('mahasiswa/krs*') ? 'bg-blue-100 text-blue-700 font-bold shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 3h8l4 4v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2zm5 5v6m-3-3h6"/>

                        </svg>

                        <span x-show="sidebarOpen">
                            Isi KRS
                        </span>

                    </a>

                    <!-- Riwayat -->
                    <a href="/mahasiswa/riwayat-krs"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200
                    {{ request()->is('mahasiswa/riwayat-krs*') ? 'bg-blue-100 text-blue-700 font-bold shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>

                        </svg>

                        <span x-show="sidebarOpen">
                            Riwayat KRS
                        </span>

                    </a>

                    <!-- KHS -->
                    <a href="/mahasiswa/khs"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200
                    {{ request()->is('mahasiswa/khs*') ? 'bg-blue-100 text-blue-700 font-bold shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />

                        </svg>

                        <span x-show="sidebarOpen">
                            KHS
                        </span>

                    </a>

                </nav>

                <!-- FOOTER -->
                <div class="absolute bottom-5 left-0 w-full text-center text-gray-400 text-sm" x-show="sidebarOpen">

                    © {{ date('Y') }} SIP.KRS

                </div>

            </aside>

            <!-- MAIN -->
            <div class="flex-1 flex flex-col min-w-0">

                <!-- NAVBAR -->
                <!-- NAVBAR -->
                <div style="background-color:#2563eb">
                    <x-navbar :title="View::yieldContent('title')" />
                </div>

                <!-- CONTENT -->
                <main class="flex-1 p-6 overflow-x-auto">
                    @yield('content')
                </main>

            </div>

        </div>

    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</div>
</html>