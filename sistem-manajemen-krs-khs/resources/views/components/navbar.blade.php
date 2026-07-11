@php
    $user = auth()->user();

    $nama = 'User';
    $foto = null;

    if ($user->role == 'admin') {
        $nama = $user->admin->nama ?? 'Admin';
        $foto = $user->admin->foto ?? null;
    } elseif ($user->role == 'dosen') {
        $nama = $user->dosen->nama ?? 'Dosen';
        $foto = $user->dosen->foto ?? null;
    } elseif ($user->role == 'mahasiswa') {
        $nama = $user->mahasiswa->nama ?? 'Mahasiswa';
        $foto = $user->mahasiswa->foto ?? null;
    }
@endphp

<header class="h-16 px-6 flex justify-between items-center text-white">

    <!-- KIRI -->
    <div class="flex items-center gap-4">

        <!-- Tombol Sidebar -->
        <button
        @click="
        if (window.innerWidth < 768) {
            openSidebar = !openSidebar
        } else {
            sidebarOpen = !sidebarOpen
        }
    "
    class="text-xl hover:opacity-80">

    ☰

</button>

        <h1 class="text-xl font-semibold">
            {{ $title }}
        </h1>

    </div>


    <!-- KANAN -->
    <div class="flex items-center gap-4">

        <!-- PROFIL -->
        <a href="{{ route('profile.index') }}"
           class="flex items-center gap-3 hover:bg-[#dcdae7] px-3 py-2 rounded-xl transition">

            <div class="text-right hidden sm:block">

                <p class="font-medium">
                    {{ $nama }}
                </p>

                <p class="text-sm text-indigo-100">
                    {{ $user->email }}
                </p>

            </div>

            @if($foto)
                <img src="{{ asset('storage/foto/'.$foto) }}"
                     class="w-10 h-10 rounded-full object-cover border-2 border-white"
                     alt="Foto Profil">
            @else
                <div class="w-10 h-10 rounded-full bg-white text-indigo-700
                            flex items-center justify-center font-bold border-2 border-white">

                    {{ strtoupper(substr($nama,0,1)) }}

                </div>
            @endif

        </a>


        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="p-2 rounded-full hover:bg-[#4f4b8a] transition">

                <svg class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/>

                </svg>

            </button>

        </form>

    </div>

</header>