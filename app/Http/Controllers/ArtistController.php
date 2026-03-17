<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Inertia\Inertia;
use Inertia\Response;

class ArtistController extends Controller
{
    public function show($id): Response
    {
        $artist = Artist::with(['songs' => function($query) {
            $query->where('status', 'approved')->orderBy('views', 'desc');
        }])->findOrFail($id);

        return Inertia::render('ArtistPage', [
            'artist' => $artist
        ]);
    }
}
