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
            <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Semua Berita & Informasi</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($posts as $post)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition duration-300">
                        <a href="{{ route('posts.show', $post) }}">
                            <img class="h-56 w-full object-cover"
                                src="{{ Illuminate\Support\Facades\Storage::url($post->thumbnail) }}"
                                alt="{{ $post->title }}">
                        </a>
                        <div class="p-6">
                            <span class="text-sm font-semibold text-indigo-600">{{ $post->category->name }}</span>
                            <h3 class="mt-2 font-bold text-xl h-16">
                                <a href="{{ route('posts.show', $post) }}"
                                    class="hover:text-indigo-700">{{ $post->title }}</a>
                            </h3>
                            <div class="mt-4 text-gray-600 text-sm">
                                {{ Str::limit(strip_tags($post->content), 100) }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="md:col-span-3 text-center text-gray-500">Belum ada berita yang dipublikasikan.</p>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        </main>
    </div>
@endsection
