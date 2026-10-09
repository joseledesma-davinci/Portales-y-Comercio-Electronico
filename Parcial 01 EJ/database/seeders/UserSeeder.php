<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder de usuarios administradores.
 */
class UserSeeder extends Seeder
{
    /**
     * Ejecuta la carga inicial de usuarios.
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
