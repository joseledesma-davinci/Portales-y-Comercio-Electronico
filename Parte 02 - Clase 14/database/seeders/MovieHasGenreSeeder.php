<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieHasGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movies_have_genres')->insert([
            [
                'movie_fk' => 1,
                'genre_fk' => 2,
            ],
            [
                'movie_fk' => 1,
                'genre_fk' => 10,
            ],
            [
                'movie_fk' => 2,
                'genre_fk' => 1,
            ],
            [
                'movie_fk' => 2,
                'genre_fk' => 2,
            ],
            [
                'movie_fk' => 2,
                'genre_fk' => 3,
            ],
            [
                'movie_fk' => 3,
                'genre_fk' => 7,
            ],
        ]);
    }
}
