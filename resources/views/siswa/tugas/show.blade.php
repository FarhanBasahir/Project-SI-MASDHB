@extends('layouts.siswa')

@section('header_title', 'Detail Tugas')

@section('content')
    <div class="space-y-6">
        <!-- Tombol Kembali -->
        <a href="{{ route('siswa.tugas.index') }}"
            class="inline-flex items-center text-white hover:text-gray-200 font-semibold">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Tugas
        </a>

        <!-- Detail Tugas -->
        <div class="bg-white/90 card-shadow p-6 rounded-2xl">
            <div class="border-b pb-4 mb-4">
                <p class="text-sm text-gray-500">{{ $tugas->mataPelajaran->nama_mapel }}</p>
                <h1 class="text-3xl font-bold text-gray-800">{{ $tugas->judul }}</h1>
                <p class="text-sm text-gray-500 mt-2">
                    Deadline: <span
                        class="font-semibold {{ now()->gt($tugas->tanggal_deadline) ? 'text-red-500' : 'text-gray-700' }}">{{ \Carbon\Carbon::parse($tugas->tanggal_deadline)->isoFormat('dddd, D MMMM YYYY, HH:mm') }}</span>
                </p>
            </div>
            <div class="prose max-w-none">
                {!! $tugas->instruksi !!}
            </div>
        </div>

        <!-- Form Pengumpulan Jawaban -->
        <div class="bg-white/90 card-shadow p-6 rounded-2xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Kumpulkan Jawaban</h2>

            @if (session('sukses'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('sukses') }}
                </div>
            @endif

            <form action="{{ route('siswa.tugas.kumpulkan', $tugas) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="jawaban_teks" class="block text-sm font-medium text-gray-700">Jawaban Teks
                            (Opsional)</label>
                        <textarea name="jawaban_teks" id="jawaban_teks" rows="5"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $jawaban->jawaban_teks ?? '' }}</textarea>
                    </div>
                    <div>
                        <label for="file_jawaban" class="block text-sm font-medium text-gray-700">Upload File
                            (Opsional)</label>
                        <input type="file" name="file_jawaban" id="file_jawaban"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @if ($jawaban && $jawaban->file_jawaban)
                            <p class="text-sm text-gray-500 mt-2">File terkirim: <a
                                    href="{{ Illuminate\Support\Facades\Storage::url($jawaban->file_jawaban) }}"
                                    class="text-indigo-600 hover:underline" target="_blank">Lihat file</a></p>
                        @endif
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-6 rounded-xl font-semibold text-lg hover:from-indigo-700 hover:to-purple-700 transition">
                            Kumpulkan Jawaban
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Status Penilaian -->
        @if ($jawaban && $jawaban->nilai)
            <div class="bg-white/90 card-shadow p-6 rounded-2xl">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Hasil Penilaian</h2>
                <div class="flex items-center space-x-4">
                    <div class="text-center">
                        <p class="text-gray-600">Nilai</p>
                        <p class="text-5xl font-bold text-green-600">{{ $jawaban->nilai }}</p>
                    </div>
                    <div class="flex-1 border-l pl-4">
                        <p class="text-gray-600 font-semibold">Catatan dari Guru:</p>
                        <div class="prose prose-sm max-w-none mt-1">{!! $jawaban->catatan_guru !!}</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
