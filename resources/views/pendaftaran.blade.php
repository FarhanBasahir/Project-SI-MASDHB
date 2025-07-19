<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru - MA Darul Huda Babai</title>
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
                        'slideUp': 'slideUp 0.5s ease-out',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.15);
        }

        .section-divider {
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-blue-50 font-sans antialiased min-h-screen">

    <!-- Header dengan animasi -->
    <div class="gradient-bg py-12 px-4 animate-fadeIn">
        <div class="container mx-auto text-center">
            <div class="mb-6">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-2">
                    Penerimaan Peserta Didik Baru
                </h1>
                <p class="text-xl text-indigo-100 font-medium">
                    Madrasah Aliyah Darul Huda Babai
                </p>
                <p class="text-indigo-200 mt-2">
                    Tahun Pelajaran 2025/2026
                </p>
            </div>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="container mx-auto px-4 -mt-6 relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">1</span>
                        </div>
                        <span class="text-indigo-600 font-medium">Data Calon Siswa</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-4 rounded-full">
                        <div class="h-full bg-indigo-600 rounded-full" style="width: 50%"></div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                            <span class="text-gray-600 font-semibold text-sm">2</span>
                        </div>
                        <span class="text-gray-500 font-medium">Data Orang Tua</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="container mx-auto px-4 pb-12">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl card-shadow overflow-hidden animate-slideUp">

                <!-- Form Content -->
                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-8 md:p-12">
                    @csrf

                    <!-- Section 1: Data Calon Siswa -->
                    <section class="mb-12">
                        <div class="flex items-center mb-8">
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Data Calon Siswa</h2>
                                <p class="text-gray-600">Lengkapi informasi pribadi calon siswa</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Nama Lengkap -->
                            <div class="md:col-span-2">
                                <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" required
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 input-focus text-gray-800 placeholder-gray-400"
                                    placeholder="Masukkan nama lengkap sesuai ijazah">
                            </div>

                            <!-- NISN -->
                            <div>
                                <label for="nisn" class="block text-sm font-semibold text-gray-700 mb-3">
                                    NISN <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nisn" id="nisn" required
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 input-focus text-gray-800 placeholder-gray-400"
                                    placeholder="Nomor Induk Siswa Nasional">
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Jenis Kelamin <span class="text-red-500">*</span>
                                </label>
                                <select name="jenis_kelamin" id="jenis_kelamin" required
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 input-focus text-gray-800">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <!-- Tempat Lahir -->
                            <div>
                                <label for="tempat_lahir" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Tempat Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" required
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 input-focus text-gray-800 placeholder-gray-400"
                                    placeholder="Kota tempat lahir">
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Tanggal Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" required
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 input-focus text-gray-800">
                            </div>

                            <!-- Agama -->
                            <div>
                                <label for="agama" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Agama <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="agama" id="agama" value="Islam" required readonly
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-800">
                            </div>

                            <!-- Asal Sekolah -->
                            <div>
                                <label for="asal_sekolah" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Asal Sekolah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="asal_sekolah" id="asal_sekolah" required
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 input-focus text-gray-800 placeholder-gray-400"
                                    placeholder="Nama SMP/MTs asal">
                            </div>

                            <!-- Alamat -->
                            <div class="md:col-span-2">
                                <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Alamat Lengkap <span class="text-red-500">*</span>
                                </label>
                                <textarea name="alamat" id="alamat" rows="4" required
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 input-focus text-gray-800 placeholder-gray-400 resize-none"
                                    placeholder="Masukkan alamat lengkap termasuk RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten"></textarea>
                            </div>
                        </div>
                    </section>

                    <section class="mb-12">
                        <div class="flex items-center mb-8">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Upload Dokumen</h2>
                                <p class="text-gray-600">Unggah file dalam format PDF atau Gambar (JPG/PNG).</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-1 gap-8">
                            <div>
                                <label for="dokumen_ijazah" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Ijazah / Surat Keterangan Lulus (PDF/JPG/PNG) <span class="text-red-500">*</span>
                                </label>
                                <input type="file" name="dokumen_ijazah" id="dokumen_ijazah" required
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            </div>

                            <div>
                                <label for="dokumen_foto" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Pas Foto 3x4 (JPG/PNG) <span class="text-red-500">*</span>
                                </label>
                                <input type="file" name="dokumen_foto" id="dokumen_foto" required
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            </div>

                            <div>
                                <label for="dokumen_kk" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Kartu Keluarga (PDF/JPG/PNG) <span class="text-red-500">*</span>
                                </label>
                                <input type="file" name="dokumen_kk" id="dokumen_kk" required
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            </div>
                        </div>
                    </section>

                    <!-- Section 2: Data Orang Tua -->
                    <section class="mb-12">
                        <div class="flex items-center mb-8">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Data Orang Tua / Wali</h2>
                                <p class="text-gray-600">Informasi orang tua atau wali calon siswa</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Nama Ayah -->
                            <div>
                                <label for="nama_ayah" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Nama Ayah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_ayah" id="nama_ayah" required
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 input-focus text-gray-800 placeholder-gray-400"
                                    placeholder="Nama lengkap ayah">
                            </div>

                            <!-- Pekerjaan Ayah -->
                            <div>
                                <label for="pekerjaan_ayah" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Pekerjaan Ayah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" required
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 input-focus text-gray-800 placeholder-gray-400"
                                    placeholder="Pekerjaan ayah">
                            </div>

                            <!-- Nama Ibu -->
                            <div>
                                <label for="nama_ibu" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Nama Ibu <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_ibu" id="nama_ibu" required
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 input-focus text-gray-800 placeholder-gray-400"
                                    placeholder="Nama lengkap ibu">
                            </div>

                            <!-- Pekerjaan Ibu -->
                            <div>
                                <label for="pekerjaan_ibu" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Pekerjaan Ibu <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" required
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 input-focus text-gray-800 placeholder-gray-400"
                                    placeholder="Pekerjaan ibu">
                            </div>

                            <!-- Nomor HP -->
                            <div class="md:col-span-2">
                                <label for="nomor_hp_ortu" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Nomor Telepon / HP Orang Tua <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="nomor_hp_ortu" id="nomor_hp_ortu" required
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 input-focus text-gray-800 placeholder-gray-400"
                                    placeholder="Contoh: 08123456789">
                            </div>
                        </div>
                    </section>

                    <!-- Submit Button -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 px-8 rounded-xl font-semibold text-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-indigo-200 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Daftar Sekarang
                            </span>
                        </button>

                        <p class="text-center text-gray-500 text-sm mt-4">
                            Dengan mendaftar, Anda menyetujui syarat dan ketentuan yang berlaku
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-400">© 2025 Madrasah Aliyah Darul Huda Babai. Semua hak dilindungi.</p>
        </div>
    </footer>

    <script>
        // Form validation dan interaktivitas
        // document.getElementById('registrationForm').addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     // Simulasi loading
        //     const submitBtn = this.querySelector('button[type="submit"]');
        //     const originalText = submitBtn.innerHTML;
        //     submitBtn.innerHTML =
        //         '<span class="flex items-center justify-center"><svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...</span>';

        //     setTimeout(() => {
        //         alert('Pendaftaran berhasil! Silakan tunggu konfirmasi lebih lanjut.');
        //         submitBtn.innerHTML = originalText;
        //     }, 2000);
        // });

        // Input animation effects
        document.querySelectorAll('input, textarea, select').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('animate-pulse');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('animate-pulse');
            });
        });
    </script>
</body>

</html>
