<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    protected $model = Artist::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->name(),
            'bio' => fake()->paragraph(),
            'profile_image' => 'https://picsum.photos/seed/'.fake()->uuid().'/400/400',
            'social_links' => [
                'twitter' => 'https://twitter.com/'.fake()->userName(),
                'instagram' => 'https://instagram.com/'.fake()->userName(),
            ],
        ];
    }
}
