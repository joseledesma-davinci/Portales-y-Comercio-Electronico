<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Seeder principal del proyecto TP2.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Ejecuta seeders en orden de dependencias entre tablas.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ServiceSeeder::class,
            PostSeeder::class,
            SubscriptionSeeder::class,
        ]);
    }
}
