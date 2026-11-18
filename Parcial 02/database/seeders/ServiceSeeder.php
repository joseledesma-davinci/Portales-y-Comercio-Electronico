<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

/**
 * Seeder del catálogo de servicios comerciales.
 */
class ServiceSeeder extends Seeder
{
    /**
     * Carga los seis servicios solicitados.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Hosting Básico',
                'synopsis' => 'Ideal para empezar con una web institucional estable y segura.',
                'description' => 'Incluye puesta en marcha, certificado SSL, monitoreo base y soporte por tickets para resolver incidencias operativas sin complicarte.',
                'price' => 6900.00,
                'image' => 'servicio-hosting.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Hosting Pro',
                'synopsis' => 'Pensado para negocios con más tráfico y procesos críticos.',
                'description' => 'Sumás mejores recursos, backups diarios y soporte prioritario para sostener campañas, lanzamientos y picos de visitas.',
                'price' => 12900.00,
                'image' => 'servicio-hosting.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Hosting Empresarial',
                'synopsis' => 'Infraestructura robusta para proyectos exigentes y crecimiento sostenido.',
                'description' => 'Abarca alta disponibilidad, monitoreo avanzado y asistencia dedicada para plataformas donde cada minuto online importa.',
                'price' => 24900.00,
                'image' => 'servicio-hosting.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Desarrollo Web a Medida',
                'synopsis' => 'Soluciones personalizadas alineadas a procesos reales de tu negocio.',
                'description' => 'Diseñamos y construimos productos digitales con foco en escalabilidad, integración con sistemas existentes y resultados medibles.',
                'price' => 180000.00,
                'image' => 'servicio-desarrollo.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Diseño y Rediseño Web',
                'synopsis' => 'Mejorá imagen, navegación y conversión con una experiencia moderna.',
                'description' => 'Actualizamos tu presencia digital para que comunique mejor, cargue rápido y acompañe tus objetivos comerciales.',
                'price' => 95000.00,
                'image' => 'servicio-desarrollo.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Mantenimiento Mensual',
                'synopsis' => 'Soporte preventivo para mantener tu sitio al día y sin sobresaltos.',
                'description' => 'Aplicamos actualizaciones, revisiones de seguridad y mejoras continuas para que tu operación siga firme todos los meses.',
                'price' => 22000.00,
                'image' => 'servicio-mantenimiento.jpg',
                'is_active' => false,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(
                ['title' => $service['title']],
                $service,
            );
        }
    }
}
