<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
            En este método run() debemos poner la lógica necesaria para cargar los registros iniciales
            en la tabla.
            ¿Cómo hacemos consultas contra la base de datos en Laravel?
            Tenemos 3 opciones:
                a. Pedirle a Laravel que nos de el objeto PDO de la conexión a la base de datos, y hacer
                    las consultas a mano.
                b. Usar el Query Builder.
                c. Usar Eloquent.

            Eloquent vamos a ver un poquitín más adelante. Por ahora, enfoquémonos en el Query Builder.
            El Query Builder nos permite armar consultas SQL a través de métodos de la clase Query Builder.
            Por ejemplo:
                DB::table('movies')
                    ->where('price', '<', 1999)
                    ->orderBy('release_date')
                    ->get();
            
            "DB" es la "fachada" (façade) para poder interactuar fácilmente con el Query Builder.

            ## Ejecutando los seeders
            Tenemos dos maneras de correr este seeder.
            Ambas se basan en el comando de Artisan: `php artisan db:seed`
            
            ### Opción 1: Aclarando el seeder que queremos correr con el flag "--class"
            Al comando `db:seed` le podemos agregar el flag "--class" que indique el nombre del seeder
            que queremos correr. Por ejemplo:
                `php artisan db:seed --class=MovieSeeder`

            Esta forma es útil cuando queremos correr un seeder en particular.


            ### Opción 2: Configurando los seeders a correr con DatabaseSeeder
            La clase DatabaseSeeder es la que Laravel ejecuta cuando corremos el comando `db:seed` sin
            especificar un seeder en particular.

            La idea es que esta clase contenga las instrucciones para seedear la base de datos completa,
            indicando qué otros seeders tienen que correr y en qué orden.

            Esto es muy útil, sobre todo a medida que vamos teniendo cada vez más y más seeders, que
            seguramente van a tener, además, dependencias entre ellos.

            Adicionalmente, como es muy común que queramos seedear la base de datos tan pronto la creamos,
            DatabaseSeeder se puede invocar junto al comando de `migrate`:
                `php artisan migrate --seed`
        */
        DB::table('movies')->insert([
            [
                'movie_id' => 1, // Opcional.
                'title' => 'El Señor de los Anillos: La Comunidad del Anillo',
                'price' => 1999,
                'release_date' => '2001-11-21',
                'synopsis' => 'Frodo y sus pequeños amigos salen de aventuras con un anillo malo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 2, // Opcional.
                'title' => 'La Matrix',
                'price' => 1799,
                'release_date' => '1999-12-05',
                'synopsis' => 'Neo sigue al conejito blanco y se mete en flor de quilombo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 3, // Opcional.
                'title' => 'El discurso del rey',
                'price' => 1599,
                'release_date' => '2011-07-22',
                'synopsis' => 'Un rey tartamudo tiene que dar un discurso de ingreso a la Segunda Guerra Mundial.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
