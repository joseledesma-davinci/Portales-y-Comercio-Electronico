<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Seeder principal del proyecto.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Ejecuta todos los seeders del parcial.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ServiceSeeder::class,
            PostSeeder::class,
        ]);
    }
}
