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
