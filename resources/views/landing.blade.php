@extends('layouts.app')

@section('content')
    <div class="gradient-bg text-white -mt-20 pt-20">
        <div class="container mx-auto px-6 py-20 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-4">
                Selamat Datang di Website Resmi
            </h1>
            <p class="text-xl md:text-2xl text-indigo-100 mb-8">
                Madrasah Aliyah Darul Huda Babai
            </p>
        </div>
    </div>

    <div class="container mx-auto px-6 py-12 -mt-16">
        
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8 mb-16">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Informasi PPDB Online</h2>
            <div class="flex flex-col md:flex-row items-center justify-between bg-gray-50 p-6 rounded-lg border">
                <div>
                    <h3 class="font-bold text-gray-700 text-lg">Status Pendaftaran Saat Ini</h3>
                    <p class="text-gray-500">Jadwal: {{ $tanggal_buka }} - {{ $tanggal_tutup }}</p>
                </div>
                <div class="mt-4 md:mt-0">
                    @if ($status_pendaftaran == 'Dibuka')
                        <a href="{{ route('pendaftaran.create') }}" class="px-4 py-2 rounded-full font-semibold text-sm bg-green-100 text-green-800">
                            ● Pendaftaran Sedang Dibuka
                        </a>
                    @elseif ($status_pendaftaran == 'Akan Datang')
                         <span class="px-4 py-2 rounded-full font-semibold text-sm bg-blue-100 text-blue-800">
                            ● Pendaftaran Akan Dibuka
                        </span>
                    @else
                        <span class="px-4 py-2 rounded-full font-semibold text-sm bg-red-100 text-red-800">
                            ● Pendaftaran Sudah Ditutup
                        </span>
                    @endif
                </div>
            </div>
             <div class="mt-6 text-center">
                 <a href="{{ route('cek-status.form') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                    Sudah Mendaftar? Cek Status Anda di sini
                </a>
             </div>
        </div>

        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Berita & Informasi Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($posts as $post)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition duration-300">
                    <img class="h-56 w-full object-cover" src="{{ Illuminate\Support\Facades\Storage::url($post->thumbnail) }}" alt="{{ $post->title }}">
                    <div class="p-6">
                        <span class="text-sm font-semibold text-indigo-600">{{ $post->category->name }}</span>
                        <h3 class="mt-2 font-bold text-xl h-16">{{ $post->title }}</h3>
                        <button @click="
                            isModalOpen = true;
                            modalContent = 'Sedang memuat berita...';
                            fetch('{{ route('posts.show.json', $post) }}')
                                .then(response => response.json())
                                .then(data => modalContent = data.html)
                            " class="mt-4 inline-block text-indigo-600 font-semibold hover:text-indigo-800">
                            Baca Selengkapnya &rarr;
                        </button>
                    </div>
                </div>
                @empty
                <p class="md:col-span-3 text-center text-gray-500">Belum ada berita yang dipublikasikan.</p>
                @endforelse
            </div>
        </div>

        <div class="max-w-6xl mx-auto mt-16">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Galeri Kegiatan</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse ($photos as $photo)
                    <div class="overflow-hidden rounded-xl">
                        <img src="{{ Illuminate\Support\Facades\Storage::url($photo->image_path) }}" alt="{{ $photo->title }}" class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                    </div>
                @empty
                    <p class="md:col-span-4 text-center text-gray-500">Belum ada foto di galeri.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div x-show="isModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50" @keydown.escape.window="isModalOpen = false" style="display: none;">
        <div @click.outside="isModalOpen = false" class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <button @click="isModalOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <div class="p-8 md:p-12" x-html="modalContent">
                </div>
        </div>
    </div>
@endsection