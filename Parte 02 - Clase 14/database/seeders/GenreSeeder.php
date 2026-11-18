<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Genre::insert(); // Podríamos usar también el modelo.
        DB::table('genres')->insert([
            [
                'genre_id' => 1,
                'name' => 'Acción',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genre_id' => 2,
                'name' => 'Aventuras',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genre_id' => 3,
                'name' => 'Drama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genre_id' => 4,
                'name' => 'Thriller',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genre_id' => 5,
                'name' => 'Comedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genre_id' => 6,
                'name' => 'Animación',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genre_id' => 7,
                'name' => 'Histórica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genre_id' => 8,
                'name' => 'Bélica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genre_id' => 9,
                'name' => 'Terror',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genre_id' => 10,
                'name' => 'Fantasía',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
