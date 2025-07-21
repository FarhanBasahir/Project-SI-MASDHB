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
        {{-- Salin bagian <main> dari file landing.blade.php lama Anda dan tempel di sini --}}
        <main class="container mx-auto px-6 py-12">
            <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Galeri Kegiatan Sekolah</h1>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($photos as $photo)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group">
                        <a href="{{ Illuminate\Support\Facades\Storage::url($photo->image_path) }}" target="_blank">
                            <img class="h-64 w-full object-cover transform group-hover:scale-110 transition duration-500"
                                src="{{ Illuminate\Support\Facades\Storage::url($photo->image_path) }}"
                                alt="{{ $photo->title }}">
                        </a>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 truncate">{{ $photo->title }}</h3>
                        </div>
                    </div>
                @empty
                    <p class="md:col-span-full text-center text-gray-500">Belum ada foto yang diunggah.</p>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $photos->links() }}
            </div>
        </main>
    </div>
@endsection
