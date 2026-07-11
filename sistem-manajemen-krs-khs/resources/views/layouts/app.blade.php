<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - SIP.KRS</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

</style>

<div style="font-family: 'Inter', sans-serif;">

    <body class="bg-gray-100 font-sans">

        <div x-data="{ openSidebar: false, sidebarOpen: true }" class="min-h-screen">

            <div class="flex min-h-screen">

                <!-- OVERLAY MOBILE -->
                <div x-show="openSidebar" @click="openSidebar = false" class="fixed inset-0 bg-black/50 z-40 md:hidden">
                </div>

                <!-- SIDEBAR -->
                <aside class="fixed md:relative z-50 bg-white min-h-screen transition-all duration-300"
                    :class="[sidebarOpen ? 'w-64' : 'w-16', openSidebar ? 'translate-x-0' : '-translate-x-full md:translate-x-0']">

                    <!-- HEADER SIDEBAR -->
                    <div class="h-16 flex items-center justify-center bg-indigo-700 text-white"
                        style="background-color: #2e2970">

                        <h2 x-show="sidebarOpen" x-transition class="text-2xl font-bold">

                            SIP.KRS

                        </h2>

                    </div>

                    <!-- MENU -->
                    <nav class="mt-4 px-2 space-y-1">

                        <!-- Dashboard -->
                        <a href="/admin/dashboard"
                            class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200
            {{ request()->is('admin/dashboard') ? 'bg-indigo-100 text-indigo-700 font-bold shadow-sm' : 'text-gray-500 hover:bg-gray-100 text-gray-700' }}">

                            <!-- ICON -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10.5L12 4l7 6.5V19a1 1 0 01-1 1h-4v-5H10v5H6a1 1 0 01-1-1v-8.5z"/>
                            </svg>

                            <span x-show="sidebarOpen">
                                Beranda
                            </span>

                        </a>

                        <!-- Pengguna -->
                        <a href="/admin/pengguna"
                            class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200
            {{ request()->is('admin/pengguna*') ? 'bg-indigo-100 text-indigo-700 font-bold shadow-sm' : 'text-gray-500 hover:bg-gray-100 text-gray-700' }}">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m8-2.13a4 4 0 10-8 0m8 0a4 4 0 11-8 0" />
                            </svg>

                            <span x-show="sidebarOpen">
                                Kelola Pengguna
                            </span>

                        </a>

                        <!-- Matkul -->
                        <a href="/admin/matkul"
                            class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200
            {{ request()->is('admin/matkul*') ? 'bg-indigo-100 text-indigo-700 font-bold shadow-sm' : 'text-gray-500 hover:bg-gray-100 text-gray-700' }}">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422A12.083 12.083 0 0120 17.944M12 14L5.84 10.578A12.083 12.083 0 004 17.944" />
                            </svg>

                            <span x-show="sidebarOpen">
                                Kelola Mata Kuliah
                            </span>

                        </a>

                        <!-- Semester -->
                        <a href="/admin/semester"
                            class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200
            {{ request()->is('admin/semester*') ? 'bg-indigo-100 text-indigo-700 font-bold shadow-sm' : 'text-gray-500 hover:bg-gray-100 text-gray-700' }}">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>

                            <span x-show="sidebarOpen">
                                Kelola Semester
                            </span>

                        </a>


                        <!-- Periode Akademik -->
                        <a href="/admin/periods"
                            class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200
                        {{ request()->is('admin/periods*') ? 'bg-indigo-100 text-indigo-700 font-bold shadow-sm' : 'text-gray-500 hover:bg-gray-100 text-gray-700' }}">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />

                            </svg>

                            <span x-show="sidebarOpen">
                                Periode Akademik
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
                    <div style="background-color: #2e2970">
                        <x-navbar :title="View::yieldContent('title')" />
                    </div>

                    <!-- CONTENT -->
                    <main class="flex-1 p-6 overflow-x-auto">
                        @yield('content')
                    </main>

                </div>

            </div>

        </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>