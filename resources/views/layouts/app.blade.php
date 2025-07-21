{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Judul akan dinamis tergantung halaman --}}
    <title>{{ $title ?? 'MA Darul Huda Babai' }}</title>
    <link rel="icon" type="images/png" sizes="16x16" href="{{ asset('images/kemenag.png') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>

<body class="bg-slate-50">

    <div class="gradient-bg text-white">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold">MA Darul Huda</div>
            <div class="hidden md:flex space-x-6 items-center">
                <a href="/" class="hover:text-indigo-200">Beranda</a>
                <a href="{{ route('profile.show', ['post' => 'visi-dan-misi']) }}"
                    class="hover:text-indigo-200">Profil</a>
                <a href="{{ route('posts.index') }}" class="hover:text-indigo-200">Berita</a>
                <a href="{{ route('gallery.index') }}" class="hover:text-indigo-200">Galeri</a>
                <a href="{{ route('pendaftaran.create') }}"
                    class="bg-white text-indigo-600 font-semibold py-2 px-4 rounded-lg hover:bg-gray-100 transition">PPDB</a>
            </div>
        </nav>
    </div>

    <main>
        @yield('content')
    </main>

    {{-- Ganti seluruh isi <footer> di resources/views/layouts/app.blade.php --}}

    <footer class="bg-gray-800 text-white pt-12 pb-8">
        <div class="container mx-auto px-6">
            {{-- Mengubah grid menjadi 4 kolom di layar medium ke atas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <div>
                    <h3 class="text-xl font-bold mb-4">MA Darul Huda Babai</h3>
                    <p class="text-gray-400">
                        Mencetak generasi yang beriman, bertakwa, cerdas, dan berakhlak mulia sesuai dengan ajaran
                        Ahlussunnah wal Jama'ah.
                    </p>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Hubungi Kami</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 mt-1 text-indigo-400 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Jl. Pendidikan No. 123, Babai, Kab. Hulu Sungai Utara, Kalimantan Selatan</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <a href="mailto:info@madarulhudababai.sch.id"
                                class="hover:text-white">info@madarulhudababai.sch.id</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            <span>(0511) 123-4567</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Temukan Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-gray-700 hover:bg-indigo-600 rounded-full flex items-center justify-center transition">
                            {{-- Facebook Icon --}}
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v2.385z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-700 hover:bg-indigo-600 rounded-full flex items-center justify-center transition">
                            {{-- Instagram Icon --}}
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.011 3.584-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.069-1.645-.069-4.85s.011-3.584.069-4.85c.149-3.225 1.664 4.771 4.919-4.919 1.266-.058 1.644.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98.059-1.281.073-1.689.073-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98-1.281-.059-1.689-.073-4.948-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.441 1.441 1.441 1.441-.645 1.441-1.441-.645-1.44-1.441-1.44z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-700 hover:bg-indigo-600 rounded-full flex items-center justify-center transition">
                            {{-- YouTube Icon --}}
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Lokasi Kami</h3>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.5967155989297!2d114.84976967363319!3d-1.9121176980704901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfb1f01bfc55389%3A0xa8092d0becaa683a!2sMAS%20DARUL%20HUDA!5e0!3m2!1sid!2sid!4v1753015720005!5m2!1sid!2sid"
                        style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-48 rounded-lg shadow-md"></iframe>
                </div>

            </div>

            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-400">
                <p>© {{ date('Y') }} Madrasah Aliyah Darul Huda Babai. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

</body>

</html>
