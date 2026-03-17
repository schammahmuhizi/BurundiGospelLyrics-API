<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Artist;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home', [
            'trending' => Song::with('artist')->where('status', 'approved')->orderBy('views', 'desc')->limit(6)->get(),
            'recent' => Song::with('artist')->where('status', 'approved')->orderBy('created_at', 'desc')->limit(12)->get(),
            'artists' => Artist::orderBy('created_at', 'desc')->limit(8)->get(),
        ]);
    }
}
