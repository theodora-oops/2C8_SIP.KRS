<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — SIP.KRS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        .grid-bg {
            background-image:
                linear-gradient(rgba(255,255,255,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.06) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .floating-card {
            animation: float 6s ease-in-out infinite;
        }
        .floating-card-2 {
            animation: float 6s ease-in-out infinite;
            animation-delay: -3s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-10px); }
        }

        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563EB, #1d4ed8);
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(37,99,235,0.35);
        }
        .btn-primary:active {
            transform: translateY(0);
        }

        .fade-up {
            animation: fadeUp 0.5s ease both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
    </style>
</head>
<body class="bg-white min-h-screen">

<div class="flex min-h-screen">

    {{-- ===================== LEFT PANEL ===================== --}}
    <div class="hidden lg:flex w-[45%] bg-blue-600 relative overflow-hidden flex-col justify-between p-12">

        {{-- Grid background --}}
        <div class="absolute inset-0 grid-bg"></div>

        {{-- Decorative circles --}}
        <div class="absolute -top-20 -left-20 w-72 h-72 bg-blue-500 rounded-full opacity-40"></div>
        <div class="absolute -bottom-24 -right-16 w-96 h-96 bg-blue-700 rounded-full opacity-50"></div>
        <div class="absolute top-1/2 right-0 w-48 h-48 bg-blue-400 rounded-full opacity-20 -translate-y-1/2 translate-x-1/2"></div>

        {{-- LOGO --}}
        <div class="relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="text-white text-xl font-bold tracking-tight">SIP.KRS</span>
            </div>
        </div>

        {{-- CENTER CONTENT --}}
        <div class="relative z-10 flex-1 flex flex-col justify-center">

            {{-- Floating mini cards --}}
            <div class="floating-card mb-8">
                <div class="bg-white/15 backdrop-blur-sm border border-white/20 rounded-2xl p-4 inline-flex items-center gap-3">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white text-xs font-semibold">Semester Aktif</p>

                        @if($semesterAktif)
                        <p class="text-blue-200 text-[11px]">
                            {{ ucfirst($semesterAktif->tipe) }}
                            {{ $semesterAktif->tahun_ajaran }}
                        </p>

                        @else
                        <p class="text-blue-100 text-xs">
                            Belum ada semester aktif
                        </p>
                        @endif

                    </div>
                </div>
            </div>

            <h1 class="text-4xl font-extrabold text-white leading-tight mb-4">
                Sistem Manajemen<br>KRS & KHS 
            </h1>
            <p class="text-blue-100 text-base leading-relaxed max-w-sm">
                Kelola KRS, input nilai mahasiswa, dan pantau perkembangan akademik dalam satu platform terintegrasi.
            </p>

            {{-- Stats --}}
            <div class="flex gap-6 mt-8">
                <div>
                    <p class="text-2xl font-bold text-white">3</p>
                    <p class="text-blue-200 text-xs mt-0.5">Hak Pengguna</p>
                </div>
                <div class="w-px bg-white/20"></div>
                <div>
                    <p class="text-2xl font-bold text-white">KRS</p>
                    <p class="text-blue-200 text-xs mt-0.5">& KHS Digital</p>
                </div>
                <div class="w-px bg-white/20"></div>
                <div>
                    <p class="text-2xl font-bold text-white">100%</p>
                    <p class="text-blue-200 text-xs mt-0.5">Terintegrasi</p>
                </div>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="relative z-10">
            <p class="text-blue-200 text-xs">© 2026 SIP.KRS — Sistem Informasi Perkuliahan</p>
        </div>
    </div>

    {{-- ===================== RIGHT PANEL ===================== --}}
    <div class="flex-1 flex items-center justify-center p-8 bg-gray-50">
        <div class="w-full max-w-md">

            {{-- Mobile logo --}}
            <div class="lg:hidden flex items-center gap-2 mb-8">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="font-bold text-gray-800 text-lg">SIP.KRS</span>
            </div>

            {{-- HEADING --}}
            <div class="mb-8 fade-up">
                <h2 class="text-3xl font-extrabold text-gray-900">Selamat Datang 👋</h2>
                <p class="text-gray-500 text-sm mt-2">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            {{-- SESSION ERROR --}}
            @if ($errors->any())
            <div class="mb-5 flex items-start gap-3 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm fade-up">
                <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                {{ $errors->first() }}
            </div>
            @endif

            @if(session('status'))
            <div class="mb-5 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm fade-up">
                {{ session('status') }}
            </div>
            @endif

            {{-- FORM --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- EMAIL  --}}
                <div class="fade-up delay-1">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Email
                    </label>
                    <input id="email" type="email" name="email"
                        value="{{ old('email') }}"
       required autofocus autocomplete="email"
       placeholder="name@kampus.com"
       class="input-field w-full border border-gray-200 bg-white rounded-xl px-4 py-3 text-sm text-gray-800
              placeholder-gray-400 focus:outline-none focus:border-blue-500 transition">
                </div>

                {{-- PASSWORD --}}
                <div class="fade-up delay-2">
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="text-sm font-semibold text-gray-700">Kata Sandi</label>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-xs text-blue-600 hover:text-blue-700 font-medium transition">
                            Lupa Kata Sandi?
                        </a>
                        @endif
                    </div>
                    <div class="relative">
                        <input id="password" type="password" name="password"
                               required autocomplete="current-password"
                               placeholder="••••••••"
                               class="input-field w-full border border-gray-200 bg-white rounded-xl px-4 py-3 pr-11 text-sm text-gray-800
                                      placeholder-gray-400 focus:outline-none focus:border-blue-500 transition">
                        <button type="button" id="togglePass"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- REMEMBER --}}
                <div class="fade-up delay-3 flex items-center gap-2">
                    <input id="remember_me" type="checkbox" name="remember"
                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer">
                    <label for="remember_me" class="text-sm text-gray-600 cursor-pointer select-none">
                        Ingat Saya
                    </label>
                </div>

                {{-- SUBMIT --}}
                <div class="fade-up delay-4 pt-1">
                    <button type="submit"
                            class="btn-primary w-full text-white font-semibold py-3 rounded-xl text-sm">
                        Masuk
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    const toggleBtn  = document.getElementById('togglePass');
    const passInput  = document.getElementById('password');

    toggleBtn?.addEventListener('click', function () {
        const isPass = passInput.type === 'password';
        passInput.type = isPass ? 'text' : 'password';
        this.querySelector('svg').style.opacity = isPass ? '0.5' : '1';
    });
</script>
</body>
</html>
