<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pendaftaran - MA Darul Huda Babai</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-4 sm:p-6 lg:p-8 flex items-center justify-center min-h-screen">
        <div class="max-w-md w-full">

            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Cek Status Pendaftaran</h1>
                    <p class="text-gray-500 mt-2">Masukkan nomor pendaftaran Anda untuk melihat status terbaru.</p>
                </div>

                <form action="{{ route('cek-status.submit') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nomor_pendaftaran" class="block text-sm font-medium text-gray-700">Nomor
                            Pendaftaran</label>
                        <input type="text" name="nomor_pendaftaran" id="nomor_pendaftaran"
                            value="{{ $nomor_pendaftaran_input ?? '' }}" required
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Contoh: PPDB-2025-0001">
                    </div>
                    <div class="mt-6">
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white py-3 px-4 rounded-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            Cek Sekarang
                        </button>
                    </div>
                </form>
            </div>

            @if (isset($siswa))
                <div class="bg-white rounded-xl shadow-lg p-8 mt-8 animate-fade-in-up">
                    <h2 class="text-2xl font-bold text-center text-gray-800">Hasil Pencarian</h2>
                    <div class="mt-6 border-t pt-6">
                        <div class="flex justify-between py-2">
                            <span class="font-medium text-gray-600">Nomor Pendaftaran</span>
                            <span class="font-bold text-gray-800">{{ $siswa->nomor_pendaftaran }}</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="font-medium text-gray-600">Nama Lengkap</span>
                            <span class="font-bold text-gray-800">{{ $siswa->nama_lengkap }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-600">Status</span>
                            @php
                                $statusColor = [
                                    'Menunggu Verifikasi' => 'bg-yellow-100 text-yellow-800',
                                    'Terverifikasi' => 'bg-blue-100 text-blue-800',
                                    'Lulus' => 'bg-green-100 text-green-800',
                                    'Ditolak' => 'bg-red-100 text-red-800',
                                ];
                            @endphp
                            <span
                                class="font-bold px-3 py-1 rounded-full text-sm {{ $statusColor[$siswa->status_pendaftaran] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $siswa->status_pendaftaran }}
                            </span>
                        </div>
                    </div>
                </div>
            @elseif(request()->isMethod('post'))
                <div class="bg-white rounded-xl shadow-lg p-8 mt-8 text-center">
                    <h2 class="text-2xl font-bold text-red-600">Data Tidak Ditemukan</h2>
                    <p class="text-gray-600 mt-2">Nomor pendaftaran **{{ $nomor_pendaftaran_input }}** tidak terdaftar
                        di sistem kami. Mohon periksa kembali nomor Anda.</p>
                </div>
            @endif

        </div>
    </div>
    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.5s ease-out forwards;
        }
    </style>
</body>

</html>
