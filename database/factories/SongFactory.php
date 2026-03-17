<?php

namespace Database\Factories;

use App\Models\Song;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

class SongFactory extends Factory
{
    protected $model = Song::class;

    public function definition(): array
    {
        $genres = ['Pop', 'Rock', 'Hip-Hop', 'Jazz', 'R&B', 'Country', 'Electronic'];
        
        return [
            'title' => fake()->sentence(3),
            'artist_id' => Artist::factory(),
            'album' => fake()->word() . ' Album',
            'lyrics' => fake()->paragraphs(5, true),
            'youtube_link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'cover_image' => 'https://picsum.photos/seed/'.fake()->uuid().'/500/500',
            'genre' => fake()->randomElement($genres),
            'release_year' => fake()->year(),
            'views' => fake()->numberBetween(100, 100000),
            'status' => 'approved',
        ];
    }
}
