<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder de cuentas de prueba para TP2.
 */
class UserSeeder extends Seeder
{
    /**
     * Crea una cuenta admin y tres cuentas de usuarios comunes.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrador DevHost',
                'email' => 'admin@estudio.test',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'María Gómez',
                'email' => 'maria@estudio.test',
                'password' => Hash::make('maria1234'),
                'role' => 'user',
            ],
            [
                'name' => 'Lucas Pérez',
                'email' => 'lucas@estudio.test',
                'password' => Hash::make('lucas1234'),
                'role' => 'user',
            ],
            [
                'name' => 'Sofía Díaz',
                'email' => 'sofia@estudio.test',
                'password' => Hash::make('sofia1234'),
                'role' => 'user',
            ],
        ];

        foreach ($users as $user) {
            User::query()->updateOrCreate(
                ['email' => $user['email']],
                $user,
            );
        }
    }
}
