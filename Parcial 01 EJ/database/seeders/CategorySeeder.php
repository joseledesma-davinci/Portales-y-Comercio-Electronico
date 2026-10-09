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
     * Ejecuta la carga inicial de categorías.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Seguridad Web', 'slug' => 'seguridad-web', 'description' => 'Buenas prácticas para blindar sitios y aplicaciones.'],
            ['name' => 'Optimización de Velocidad', 'slug' => 'optimizacion-velocidad', 'description' => 'Mejoras de performance para reducir tiempos de carga.'],
            ['name' => 'Novedades Tecnológicas', 'slug' => 'novedades-tecnologicas', 'description' => 'Tendencias y herramientas nuevas del ecosistema digital.'],
            ['name' => 'Hosting Profesional', 'slug' => 'hosting-profesional', 'description' => 'Infraestructura, uptime y escalabilidad para empresas.'],
            ['name' => 'Desarrollo a Medida', 'slug' => 'desarrollo-a-medida', 'description' => 'Procesos de diseño y programación orientados al negocio.'],
            ['name' => 'Mantenimiento Evolutivo', 'slug' => 'mantenimiento-evolutivo', 'description' => 'Actualizaciones y soporte continuo para tus plataformas.'],
        ];

        foreach ($categories as $category) {
            Category::query()->updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
