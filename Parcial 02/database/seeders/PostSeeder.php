<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Seeder de publicaciones del blog institucional.
 */
class PostSeeder extends Seeder
{
    /**
     * Inserta ocho publicaciones, una de ellas en borrador.
     */
    public function run(): void
    {
        $admin = User::query()->where('email', 'admin@estudio.test')->firstOrFail();

        $posts = [
            [
                'category_slug' => 'seguridad-web',
                'title' => 'Checklist de seguridad web para arrancar 2026 con la casa en orden',
                'synopsis' => 'Una guía concreta para reducir riesgos comunes antes de que se transformen en incidentes reales.',
                'content' => "Si tu sitio es clave para vender, no alcanza con tenerlo online: también tiene que estar protegido de forma activa. Lo primero es revisar versiones de sistema, plugins y dependencias para evitar vulnerabilidades conocidas.\n\nDespués conviene reforzar credenciales, activar doble factor y limitar accesos de administración solo al personal que realmente lo necesita. Estas medidas sencillas bajan muchísimo la superficie de ataque.\n\nPor último, es fundamental contar con backups probados y monitoreo de actividad sospechosa. Cuando hay un incidente, llegar rápido hace la diferencia entre una molestia menor y una caída que impacta en ingresos.",
                'image' => 'blog-seguridad.jpg',
                'published_at' => '2026-02-14',
            ],
            [
                'category_slug' => 'seguridad-web',
                'title' => 'Cómo armar una política de contraseñas sin volver loco al equipo',
                'synopsis' => 'Equilibrio entre seguridad y usabilidad para evitar fricción innecesaria en el día a día.',
                'content' => "Muchas empresas fallan en seguridad porque imponen reglas extremas que la gente termina esquivando. El objetivo real no es incomodar, sino construir hábitos seguros y sostenibles.\n\nUna buena política combina claves robustas, doble factor y gestores de contraseñas corporativos. Además, conviene bloquear claves filtradas en brechas públicas para evitar reutilización riesgosa.\n\nCuando se comunica bien el porqué de cada medida, el cumplimiento sube y el área técnica deja de pelear contra conductas improvisadas. Seguridad y productividad pueden convivir, che.",
                'image' => 'blog-seguridad.jpg',
                'published_at' => '2026-03-03',
            ],
            [
                'category_slug' => 'optimizacion',
                'title' => 'Core Web Vitals: qué tocar primero cuando la web está lenta',
                'synopsis' => 'Priorizá mejoras de alto impacto para acelerar carga y mejorar conversiones.',
                'content' => "Cuando un sitio tarda en responder, el usuario abandona antes de leer tu propuesta de valor. Por eso, empezar por Core Web Vitals te ayuda a ordenar el trabajo con métricas concretas.\n\nOptimizar imágenes, reducir scripts bloqueantes y mejorar caché suele generar mejoras rápidas en LCP e INP. No hace falta rehacer todo para ver resultados visibles.\n\nLa clave está en medir antes y después de cada cambio. Sin datos, se pierde foco; con datos, podés justificar inversión y mostrar impacto real en negocio.",
                'image' => 'blog-velocidad.jpg',
                'published_at' => '2026-03-21',
            ],
            [
                'category_slug' => 'optimizacion',
                'title' => 'CDN y caché inteligente: el combo para bancar picos de tráfico',
                'synopsis' => 'Estrategias de infraestructura para sostener campañas y eventos sin caídas.',
                'content' => "Un CDN bien configurado distribuye contenido estático cerca del usuario y reduce latencia. Pero su verdadero potencial aparece cuando se combina con políticas de caché bien pensadas.\n\nLa recomendación es definir expiraciones por tipo de recurso y usar purgas selectivas para no romper contenido crítico. Eso evita sobrecargar el servidor de origen en momentos de alta demanda.\n\nEn tiendas y sitios de leads, estos ajustes mejoran experiencia y también estabilidad operativa. El resultado no es solo velocidad: es continuidad comercial.",
                'image' => 'blog-velocidad.jpg',
                'published_at' => '2026-04-10',
            ],
            [
                'category_slug' => 'novedades',
                'title' => 'Tendencias tecnológicas que van a marcar proyectos web este año',
                'synopsis' => 'Panorama práctico para decidir en qué tecnologías conviene invertir hoy.',
                'content' => "La conversación tecnológica cambia rápido, pero no todo merece prioridad inmediata. En 2026 estamos viendo fuerte adopción de automatización asistida por IA y observabilidad desde etapas tempranas.\n\nTambién crece el foco en performance sustentable: menos dependencia innecesaria y arquitecturas más simples de mantener. Esto baja costos y mejora tiempos de entrega.\n\nLa decisión correcta no es seguir modas, sino elegir herramientas que realmente potencien el negocio y el equipo. Lo estratégico sigue siendo criterio, no hype.",
                'image' => 'blog-novedades.jpg',
                'published_at' => '2026-05-02',
            ],
            [
                'category_slug' => 'desarrollo',
                'title' => 'Cuándo conviene desarrollar a medida y cuándo no',
                'synopsis' => 'Una mirada honesta para evitar sobreingeniería en etapas tempranas de producto.',
                'content' => "Desarrollar a medida puede ser una gran decisión si tu proceso de negocio tiene reglas particulares. En esos casos, adaptar software genérico suele salir más caro a mediano plazo.\n\nAhora, si estás validando una idea, conviene empezar liviano y evolucionar con evidencia. Lo importante es no comprometer arquitectura futura por resolver urgencias del presente.\n\nUn enfoque por etapas permite crecer con control: primero validar, después robustecer y finalmente escalar sin perder gobernabilidad técnica.",
                'image' => null,
                'published_at' => '2026-05-18',
            ],
            [
                'category_slug' => 'desarrollo',
                'title' => 'Buenas prácticas para que una web sea fácil de mantener',
                'synopsis' => 'Pequeñas decisiones de arquitectura que evitan dolores de cabeza más adelante.',
                'content' => "El mantenimiento no arranca cuando aparece un bug: arranca en la primera línea de código. Convenciones claras, estructura consistente y validaciones robustas son una inversión enorme.\n\nTambién ayuda documentar decisiones clave y automatizar chequeos básicos. Cuando entra gente nueva al equipo, esa claridad reduce tiempos de onboarding y errores evitables.\n\nPensar en mantenibilidad no es lujo técnico: es una forma concreta de proteger presupuesto, tiempos y calidad del producto digital.",
                'image' => null,
                'published_at' => '2026-06-04',
            ],
            [
                'category_slug' => 'seguridad-web',
                'title' => 'Plan interno de contingencia ante incidentes de seguridad',
                'synopsis' => 'Borrador operativo para ordenar responsables, tiempos y protocolos de comunicación.',
                'content' => "Este documento interno define niveles de criticidad y acciones iniciales para contener incidentes de seguridad en plataformas administradas por el estudio.\n\nIncluye protocolos de aislamiento, comunicación al cliente y preservación de evidencia para análisis posterior. También contempla ventanas de revisión y simulacros técnicos trimestrales.\n\nSe mantiene como borrador hasta completar la validación legal y contractual con cada tipo de cliente.",
                'image' => null,
                'published_at' => null,
            ],
        ];

        foreach ($posts as $post) {
            $category = Category::query()->where('slug', $post['category_slug'])->firstOrFail();

            Post::query()->updateOrCreate(
                ['title' => $post['title']],
                [
                    'user_id' => $admin->id,
                    'category_id' => $category->id,
                    'title' => $post['title'],
                    'synopsis' => $post['synopsis'],
                    'content' => $post['content'],
                    'image' => $post['image'],
                    'published_at' => $post['published_at'],
                ]
            );
        }
    }
}
