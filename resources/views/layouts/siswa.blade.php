<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Siswa' }} - LMS MA Darul Huda</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
        }

        .card-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="gradient-bg font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="relative min-h-screen">
        <aside :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
            class="fixed inset-y-0 left-0 z-40 w-64 bg-gray-900/80 text-white backdrop-blur-lg transform transition-transform duration-300 ease-in-out">
            <div class="px-4 py-6 text-center border-b border-gray-700">
                <h2 class="text-2xl font-bold">Portal Siswa</h2>
                <p class="text-sm text-gray-400">MA Darul Huda</p>
            </div>
            <nav class="mt-4 text-gray-300">
                <a href="{{ route('siswa.dashboard') }}"
                    class="block px-4 py-3 hover:bg-indigo-600 hover:text-white">Beranda</a>
                <a href="{{ route('siswa.materi.index') }}"
                    class="block px-4 py-3 hover:bg-indigo-600 hover:text-white">Materi
                    Pelajaran</a>
                <a href="{{ route('siswa.tugas.index') }}"
                    class="block px-4 py-3 hover:bg-indigo-600 hover:text-white">Tugas</a>
                <a href="{{ route('siswa.nilai.index') }}"
                    class="block px-4 py-3 hover:bg-indigo-600 hover:text-white">Nilai</a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col transition-all duration-300 ease-in-out" :class="{ 'md:ml-64': sidebarOpen }">
            <header
                class="flex items-center justify-between p-4 bg-white/10 backdrop-blur-lg text-white sticky top-0 z-30">
                <button @click.stop="sidebarOpen = !sidebarOpen" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="font-semibold text-xl">@yield('header_title', 'Dasbor')</div>
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="dropdownOpen" @click.outside="dropdownOpen = false"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <form method="POST" action="{{ route('siswa.logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
