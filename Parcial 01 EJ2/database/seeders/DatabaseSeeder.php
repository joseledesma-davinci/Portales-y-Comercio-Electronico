<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Seeder principal de la aplicación.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Ejecuta los seeders en el orden requerido por las dependencias.
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
