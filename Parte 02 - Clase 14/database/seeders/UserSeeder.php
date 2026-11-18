<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Saraza',
            'email' => 'sara@za.com',
            // Hash es la clase que Laravel provee para el hasheo de datos, como el password.
            // Internamente esta función utiliza bcrypt(), que es la misma función que por defecto utiliza
            // password_hash().
            // Esto significa que, en principio, podríamos usar directamente alguna de esas dos funciones
            // para hashear el password.
            // Pero no es recomendable. La razón es que para el módulo de autenticación Laravel depende
            // de la clase Hash.
            // Y existe la posibilidad, si bien es muy remota, de que en futuras versiones Laravel cambie
            // el algoritmo de hasheo que utiliza.
            // En ese escenario si estamos hasheando manualmente con bcrypt o password_hash, nuestro código
            // se vuelve incompatible con la autenticación de Laravel.
            // Mientras que si usamos la clase Hash directamente, nos aseguramos de siempre estar usando
            // lo mismo que Laravel para el hasheo de passwrods.
            'password' => Hash::make('asdasd'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
