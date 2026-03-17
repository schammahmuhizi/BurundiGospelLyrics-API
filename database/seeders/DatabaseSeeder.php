<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Artist;
use App\Models\Song;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create 10 Artists (Each with a User)
        $artists = Artist::factory()->count(10)->create();

        // Create 30 Songs (Distributed among the 10 artists)
        for ($i = 0; $i < 30; $i++) {
            Song::factory()->create([
                'artist_id' => $artists->random()->id,
            ]);
        }
    }
}
