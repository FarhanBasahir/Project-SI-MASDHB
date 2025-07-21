<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Gallery::latest()->paginate(12); // Tampilkan 12 foto per halaman
        return view('gallery.index', ['photos' => $photos]);
    }
}