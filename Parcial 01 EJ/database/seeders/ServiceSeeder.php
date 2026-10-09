<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

/**
 * Seeder de servicios ofrecidos por el estudio.
 */
class ServiceSeeder extends Seeder
{
    /**
     * Ejecuta la carga inicial de servicios.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Hosting Básico',
                'slug' => 'hosting-basico',
                'category' => 'Planes de Hosting',
                'short_description' => 'Ideal para webs institucionales que recién arrancan.',
                'description' => 'Plan de entrada con SSL, backups semanales, monitoreo 24/7 y soporte por ticket para que publiques tu sitio sin dolores de cabeza.',
                'price' => 14999.00,
                'billing_cycle' => 'mensual',
                'features' => "1 sitio\n10 GB SSD\nSSL gratis\nBackups semanales",
                'included_support' => true,
                'featured' => false,
                'active' => true,
            ],
            [
                'name' => 'Hosting Pro',
                'slug' => 'hosting-pro',
                'category' => 'Planes de Hosting',
                'short_description' => 'Pensado para e-commerce y portales con tráfico constante.',
                'description' => 'Incluye más recursos de CPU y RAM, backups diarios, panel avanzado y asistencia prioritaria para sostener picos de visitas.',
                'price' => 28999.00,
                'billing_cycle' => 'mensual',
                'features' => "3 sitios\n50 GB SSD NVMe\nBackups diarios\nCDN incluido",
                'included_support' => true,
                'featured' => true,
                'active' => true,
            ],
            [
                'name' => 'Hosting Empresarial',
                'slug' => 'hosting-empresarial',
                'category' => 'Planes de Hosting',
                'short_description' => 'Infraestructura robusta para negocios críticos.',
                'description' => 'Disponibilidad garantizada, escalado automático, monitoreo de seguridad y soporte dedicado para empresas que no pueden frenar.',
                'price' => 57999.00,
                'billing_cycle' => 'mensual',
                'features' => "Sitios ilimitados\n120 GB SSD NVMe\nWAF administrado\nSoporte dedicado",
                'included_support' => true,
                'featured' => true,
                'active' => true,
            ],
            [
                'name' => 'Desarrollo Web Corporativo',
                'slug' => 'desarrollo-web-corporativo',
                'category' => 'Desarrollo Web',
                'short_description' => 'Sitios y sistemas a medida orientados a resultados.',
                'description' => 'Diseñamos y programamos plataformas escalables con foco en UX, SEO técnico y objetivos comerciales concretos.',
                'price' => 780000.00,
                'billing_cycle' => 'proyecto único',
                'features' => "Discovery funcional\nDiseño UI/UX\nDesarrollo Laravel\nCapacitación inicial",
                'included_support' => true,
                'featured' => true,
                'active' => true,
            ],
            [
                'name' => 'Mantenimiento Mensual',
                'slug' => 'mantenimiento-mensual',
                'category' => 'Mantenimiento',
                'short_description' => 'Soporte continuo para mantener tu web al día.',
                'description' => 'Nos ocupamos de actualizaciones, correcciones, backups y monitoreo para que tu equipo se enfoque en vender.',
                'price' => 94000.00,
                'billing_cycle' => 'mensual',
                'features' => "Hasta 12 horas técnicas\nBackups diarios\nMonitoreo uptime\nInforme mensual",
                'included_support' => true,
                'featured' => false,
                'active' => true,
            ],
            [
                'name' => 'Pack Optimización de Velocidad',
                'slug' => 'pack-optimizacion-velocidad',
                'category' => 'Mantenimiento',
                'short_description' => 'Auditoría y mejoras para acelerar tu sitio.',
                'description' => 'Analizamos Core Web Vitals, optimizamos frontend/backend y dejamos un plan de mejoras priorizado por impacto.',
                'price' => 165000.00,
                'billing_cycle' => 'servicio puntual',
                'features' => "Auditoría técnica\nOptimización de imágenes\nMejoras de caché\nInforme final",
                'included_support' => true,
                'featured' => false,
                'active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
