<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Artist;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return Inertia::render('AdminPanel', [
                'stats' => [
                    'totalSongs' => Song::count(),
                    'pendingSongs' => Song::where('status', 'pending')->count(),
                    'totalArtists' => Artist::count(),
                    'totalViews' => Song::sum('views'),
                ],
                'pendingSongs' => Song::with('artist')->where('status', 'pending')->get(),
                'users' => User::all(),
            ]);
        }

        // For artists
        $artist = $user->artist;
        $songs = $artist ? $artist->songs()->orderBy('created_at', 'desc')->get() : [];

        return Inertia::render('ArtistDashboard', [
            'songs' => $songs
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('SongForm', [
            'isEdit' => false
        ]);
    }

    public function edit(Song $song): Response
    {
        return Inertia::render('SongForm', [
            'song' => $song,
            'isEdit' => true
        ]);
    }
}
