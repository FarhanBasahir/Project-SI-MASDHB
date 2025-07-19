<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil! - MA Darul Huda Babai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fadeIn': 'fadeIn 0.6s ease-in-out',
                        'slideUp': 'slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1)',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .card-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-slate-50 to-blue-50 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div
        class="max-w-2xl w-full bg-white rounded-2xl card-shadow overflow-hidden text-center p-8 md:p-12 animate-fadeIn">

        <div class="w-28 h-28 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 relative">
            <div class="absolute inset-0 bg-green-500 rounded-full animate-ping opacity-20"></div>
            <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>

        <div class="animate-slideUp">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800">
                Pendaftaran Berhasil!
            </h1>
            <p class="text-gray-600 mt-4 text-lg">
                Terima kasih, <span class="font-semibold text-indigo-600">{{ $siswa->nama_lengkap }}</span>.
                Data pendaftaran Anda telah kami simpan.
            </p>

            <div class="mt-8 bg-indigo-50 border-2 border-dashed border-indigo-200 rounded-xl p-6">
                <p class="text-gray-700 text-sm tracking-widest uppercase">Nomor Pendaftaran Anda</p>
                <p class="text-5xl font-extrabold text-indigo-600 tracking-wider mt-2">{{ $siswa->nomor_pendaftaran }}
                </p>
            </div>

            <div class="mt-8 text-center">
                <p class="text-gray-500">
                    Mohon catat dan simpan nomor ini baik-baik. Nomor Pendaftaran akan digunakan untuk mengecek status
                    dan melakukan daftar ulang.
                </p>
            </div>

            <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('pendaftaran.cetak_pdf', ['id' => $siswa->id]) }}"
                    class="w-full sm:w-auto bg-gray-700 text-white py-3 px-6 rounded-xl font-semibold hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-2">
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                            </path>
                        </svg>
                        Unduh Bukti PDF
                    </span>
                </a>
                <a href="/"
                    class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-indigo-200 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-2">
                    <span>Kembali ke Beranda</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
