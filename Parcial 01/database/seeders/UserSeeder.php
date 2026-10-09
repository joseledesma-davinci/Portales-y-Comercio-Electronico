<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder de usuario administrador.
 */
class UserSeeder extends Seeder
{
    /**
     * Ejecuta la carga de usuarios base.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@estudio.test'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
