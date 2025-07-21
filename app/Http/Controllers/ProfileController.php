<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Post $post)
    {
        // Kita gunakan view yang sama dengan detail berita
        return view('posts.show', [
            'post' => $post
        ]);
    }
}