<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen - SIP.KRS</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ALPINE JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 font-sans">

<div x-data="{ openSidebar: false }" class="min-h-screen">

    <!-- MOBILE TOPBAR -->
    <div class="md:hidden bg-slate-800 text-white flex items-center justify-between px-4 py-3">

        <h1 class="text-xl font-bold">
            SIP.KRS
        </h1>

        <!-- HAMBURGER -->
        <button @click="openSidebar = true" class="text-2xl">
            ☰
        </button>

    </div>

    <div class="flex min-h-screen">

        <!-- OVERLAY -->
        <div
            x-show="openSidebar"
            @click="openSidebar = false"
            class="fixed inset-0 bg-black/50 z-40 md:hidden"
            x-transition>
        </div>

        <!-- SIDEBAR -->
        <aside
            class="fixed md:static top-0 left-0 z-50 w-64 bg-slate-800 text-white min-h-screen p-5 flex flex-col
            transform transition-transform duration-300
            -translate-x-full md:translate-x-0"
            :class="{ 'translate-x-0': openSidebar }">

            <!-- HEADER -->
            <div class="flex items-center justify-between md:block">

                <!-- LOGO -->
                <h2 class="text-2xl font-bold mb-0 md:mb-8 text-center">
                    SIP.KRS
                </h2>

                <!-- CLOSE -->
                <button
                    @click="openSidebar = false"
                    class="md:hidden text-2xl">
                    ✕
                </button>

            </div>

            <!-- MENU -->
            <nav class="space-y-2 flex-1 mt-8 md:mt-0">

                <a href="/dosen/dashboard"
                    class="block px-4 py-2 rounded transition
                    {{ request()->is('dosen/dashboard') ? 'bg-slate-700' : 'hover:bg-slate-700' }}">

                    Dashboard
                </a>

                <a href="/dosen/kelas"
                    class="block px-4 py-2 rounded transition
                    {{ request()->is('dosen/kelas*') ? 'bg-slate-700' : 'hover:bg-slate-700' }}">

                    Kelas Diampu
                </a>

                <a href="/dosen/nilai"
                    class="block px-4 py-2 rounded transition
                    {{ request()->is('dosen/nilai*') ? 'bg-slate-700' : 'hover:bg-slate-700' }}">

                    Input Nilai
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
            <header class="bg-white shadow px-4 md:px-6 py-4 flex justify-between items-center">

                <!-- TITLE -->
                <h1 class="text-lg md:text-xl font-semibold">
                    @yield('title')
                </h1>

                <!-- RIGHT -->
                <div class="flex items-center gap-2 md:gap-4">

                    <!-- USER INFO -->
                    <div class="text-right hidden sm:block">
                        <p class="font-medium text-sm md:text-base">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs md:text-sm text-gray-500">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <!-- PROFILE -->
                    <img
                        src="https://i.pravatar.cc/40?u={{ auth()->user()->id }}"
                        class="w-9 h-9 md:w-10 md:h-10 rounded-full border"
                        alt="profile">

                    <!-- LOGOUT -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button class="p-2 rounded-full hover:bg-red-100 transition">

                            <svg class="w-5 h-5 md:w-6 md:h-6 text-red-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1" />

                            </svg>

                        </button>

                    </form>

                </div>

            </header>

            <!-- CONTENT -->
            <main class="p-4 md:p-6">
                @yield('content')
            </main>

        </div>

    </div>

</div>

</body>
</html>