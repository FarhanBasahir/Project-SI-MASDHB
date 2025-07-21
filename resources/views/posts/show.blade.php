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
            <div class="max-w-4xl mx-auto mb-6">
                <a href="{{ route('landing') }}"
                    class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-semibold">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            <article class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8 md:p-12">
                <div class="mb-8 text-center">
                    <span class="text-indigo-600 font-semibold">{{ $post->category->name }}</span>
                    <h1 class="text-3xl md:text-5xl font-extrabold text-gray-800 mt-2">{{ $post->title }}</h1>
                    <p class="text-gray-500 mt-4">
                        Dipublikasikan pada {{ $post->created_at->isoFormat('D MMMM Y') }} oleh {{ $post->user->name }}
                    </p>
                </div>

                @if ($post->thumbnail)
                    <img class="w-full h-auto max-h-[500px] object-cover rounded-2xl shadow-lg mb-8"
                        src="{{ Illuminate\Support\Facades\Storage::url($post->thumbnail) }}" alt="{{ $post->title }}">
                @endif

                <div class="prose prose-lg max-w-none">
                    {!! $post->content !!}
                </div>
            </article>
        </main>
    </div>
@endsection
