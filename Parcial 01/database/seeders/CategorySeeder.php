<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

/**
 * Seeder de categorías del blog.
 */
class CategorySeeder extends Seeder
{
    /**
     * Inserta categorías del dominio de contenidos.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Seguridad Web',
                'slug' => 'seguridad-web',
                'description' => 'Buenas prácticas para proteger sitios, credenciales e infraestructura.',
            ],
            [
                'name' => 'Optimización',
                'slug' => 'optimizacion',
                'description' => 'Mejoras de velocidad, rendimiento y experiencia de usuario.',
            ],
            [
                'name' => 'Novedades',
                'slug' => 'novedades',
                'description' => 'Tendencias y tecnologías que impactan en negocios digitales.',
            ],
            [
                'name' => 'Desarrollo',
                'slug' => 'desarrollo',
                'description' => 'Procesos, arquitectura y calidad en desarrollo web profesional.',
            ],
        ];

        foreach ($categories as $category) {
            Category::query()->updateOrCreate(
                ['slug' => $category['slug']],
                $category,
            );
        }
    }
}
