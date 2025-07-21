<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')
                     ->latest()
                     ->paginate(9); // Tampilkan 9 post per halaman

        return view('posts.index', ['posts' => $posts]);
    }
    
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function showJson(Post $post)
    {
        $html = view('posts.partials.detail', ['post' => $post])->render();

        return response()->json(['html' => $html]);
    }
}

