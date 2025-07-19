<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Ditutup - MA Darul Huda Babai</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans flex items-center justify-center min-h-screen">
    <div class="max-w-xl text-center bg-white p-10 rounded-lg shadow-lg">
        <div class="w-20 h-20 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-6">
            <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-800">Pendaftaran Ditutup</h1>
        <p class="mt-3 text-gray-600 text-lg">
            Mohon maaf, periode pendaftaran peserta didik baru telah ditutup.
        </p>
        @if(isset($tanggal_buka))
        <p class="mt-2 text-gray-500">
            Periode pendaftaran berlangsung dari tanggal {{ $tanggal_buka }} hingga {{ $tanggal_tutup }}.
        </p>
        @endif
        <div class="mt-8">
            <a href="/" class="bg-indigo-600 text-white py-3 px-6 rounded-md font-semibold hover:bg-indigo-700 transition">
                Kembali ke Halaman Utama
            </a>
        </div>
    </div>
</body>
</html>