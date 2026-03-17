<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SongController extends Controller
{
    public function show($id): Response
    {
        $song = Song::with('artist')->findOrFail($id);
        
        // Simple view counting
        $song->increment('views');
        
        return Inertia::render('SongPage', [
            'song' => $song
        ]);
    }

    public function search(Request $request): Response
    {
        $query = $request->input('q');
        $results = [];

        if ($query) {
            $results = Song::with('artist')
                ->where('status', 'approved')
                ->where(function($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('lyrics', 'like', "%{$query}%");
                })
                ->get();
        }

        return Inertia::render('SearchPage', [
            'results' => $results,
            'query' => $query
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'lyrics' => 'required|string',
            'album' => 'nullable|string|max:255',
            'youtube_link' => 'nullable|url',
            'cover_image' => 'nullable|url',
            'genre' => 'nullable|string|max:100',
            'release_year' => 'nullable|integer',
        ]);

        $artist = auth()->user()->artist;
        if (!$artist) {
            return redirect()->back()->with('error', 'You must be an artist to post lyrics.');
        }

        $song = $artist->songs()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Lyrics published successfully and are pending approval.');
    }

    public function update(Request $request, Song $song)
    {
        // Check authorization
        if (auth()->user()->role !== 'admin' && auth()->user()->id !== $song->artist->user_id) {
            abort(403);
        }

        if (auth()->user()->role === 'admin' && $request->has('status')) {
             $song->update(['status' => $request->status]);
             return redirect()->back();
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'lyrics' => 'required|string',
            'album' => 'nullable|string|max:255',
            'youtube_link' => 'nullable|url',
            'cover_image' => 'nullable|url',
            'genre' => 'nullable|string|max:100',
            'release_year' => 'nullable|integer',
        ]);

        $song->update($validated);

        return redirect()->route('dashboard')->with('success', 'Lyrics updated successfully.');
    }

    public function destroy(Song $song)
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->id !== $song->artist->user_id) {
            abort(403);
        }

        $song->delete();
        return redirect()->back()->with('success', 'Song deleted.');
    }
}
