<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Seeder de publicaciones del blog en español.
 */
class PostSeeder extends Seeder
{
    /**
     * Ejecuta la carga de artículos iniciales del blog.
     */
    public function run(): void
    {
        $admin = User::query()->where('email', 'admin@estudio.test')->firstOrFail();

        $posts = [
            [
                'category_slug' => 'seguridad-web',
                'title' => 'Checklist urgente para blindar tu WordPress en 2026',
                'slug' => 'checklist-blindar-wordpress-2026',
                'excerpt' => 'Una guía práctica para cerrar vulnerabilidades frecuentes y evitar caídas por ataques automatizados.',
                'content' => 'Si tenés un sitio en WordPress, lo primero es actualizar núcleo, plugins y tema base. Después, aplicá autenticación en dos pasos, limitá intentos de acceso y configurá copias de seguridad fuera del servidor principal. Sumá un WAF y revisá permisos de archivos para evitar escaladas de privilegios. Desde el estudio recomendamos auditar logs semanalmente para detectar actividad sospechosa antes de que el incidente impacte en ventas.',
                'status' => 'publicado',
                'reading_time_minutes' => 5,
            ],
            [
                'category_slug' => 'seguridad-web',
                'title' => 'Cómo implementar políticas de contraseñas sin frenar a tu equipo',
                'slug' => 'politicas-de-contrasenas-sin-frenar-equipo',
                'excerpt' => 'La seguridad no tiene por qué ser una traba si definís reglas claras y automatizás controles.',
                'content' => 'Una política efectiva combina longitud mínima, rotación cuando hay riesgo real y uso de gestores de contraseñas. Evitá forzar cambios mensuales sin motivo porque eso suele generar claves débiles. En proyectos corporativos, integrar SSO y MFA mejora la seguridad y simplifica la experiencia. También conviene bloquear credenciales comprometidas usando bases de datos de brechas públicas.',
                'status' => 'publicado',
                'reading_time_minutes' => 4,
            ],
            [
                'category_slug' => 'optimizacion-velocidad',
                'title' => 'Core Web Vitals: qué métricas mirar para mejorar conversiones',
                'slug' => 'core-web-vitals-metricas-para-conversiones',
                'excerpt' => 'Te contamos cómo interpretar LCP, INP y CLS para acelerar la experiencia y vender más.',
                'content' => 'El LCP mide el tiempo de carga del elemento principal, el INP evalúa respuesta a interacción y el CLS controla saltos visuales. Si tu home carga en más de 2.5 segundos, seguramente estés perdiendo oportunidades. Ajustar imágenes, eliminar JavaScript innecesario y mejorar caché del servidor suele tener impacto inmediato. Medí antes y después para priorizar tareas con datos reales.',
                'status' => 'publicado',
                'reading_time_minutes' => 6,
            ],
            [
                'category_slug' => 'optimizacion-velocidad',
                'title' => 'CDN + caché inteligente: combo clave para picos de tráfico',
                'slug' => 'cdn-cache-inteligente-para-picos-trafico',
                'excerpt' => 'Estrategias simples para sostener rendimiento cuando llegan campañas o eventos masivos.',
                'content' => 'Configurar un CDN no alcanza: también hay que definir reglas de expiración por tipo de recurso y purgas selectivas. Para ecommerce recomendamos separar contenido estático del dinámico y usar caché por usuario cuando aplique. Con una buena configuración, podés reducir carga en origen y mejorar tiempos de respuesta globales. Esto impacta directo en SEO técnico y experiencia de compra.',
                'status' => 'publicado',
                'reading_time_minutes' => 5,
            ],
            [
                'category_slug' => 'novedades-tecnologicas',
                'title' => 'Tendencias de desarrollo web que pisan fuerte este año',
                'slug' => 'tendencias-desarrollo-web-2026',
                'excerpt' => 'Repaso de tecnologías y enfoques que están marcando la agenda digital en empresas.',
                'content' => 'La adopción de arquitecturas híbridas, edge rendering y herramientas de IA para testing viene creciendo fuerte. En backend, Laravel sigue consolidándose por velocidad de desarrollo y mantenibilidad. También gana terreno la observabilidad desde etapas tempranas del proyecto, con métricas integradas de negocio y performance. El diferencial ya no es solo lanzar rápido, sino sostener calidad en producción.',
                'status' => 'publicado',
                'reading_time_minutes' => 5,
            ],
            [
                'category_slug' => 'novedades-tecnologicas',
                'title' => 'Qué cambia con HTTP/3 y por qué te conviene migrar',
                'slug' => 'que-cambia-con-http3',
                'excerpt' => 'Beneficios reales de pasar a HTTP/3 para mejorar velocidad y estabilidad de conexión.',
                'content' => 'HTTP/3 usa QUIC y reduce latencia especialmente en redes inestables. Esto mejora la percepción de velocidad en mobile y disminuye cortes de carga parciales. Migrar implica validar compatibilidad de tu infraestructura, balanceador y CDN. Antes de activar en producción, hacé pruebas controladas para medir errores, tiempos y comportamiento de sesiones.',
                'status' => 'publicado',
                'reading_time_minutes' => 4,
            ],
            [
                'category_slug' => 'mantenimiento-evolutivo',
                'title' => 'Mantenimiento web proactivo: cuánto te ahorra en incidentes',
                'slug' => 'mantenimiento-web-proactivo-ahorro',
                'excerpt' => 'No esperar al problema es la forma más barata de sostener una plataforma saludable.',
                'content' => 'Un plan mensual de mantenimiento incluye monitoreo, parches de seguridad, revisión de logs y pruebas de respaldo. Muchas caídas graves se podrían evitar con controles simples y constantes. Además, mantener dependencias actualizadas reduce deuda técnica y costo de cambios futuros. Si tu sitio factura, tratar el mantenimiento como inversión es clave.',
                'status' => 'publicado',
                'reading_time_minutes' => 5,
            ],
            [
                'category_slug' => 'hosting-profesional',
                'title' => 'Cómo elegir un plan de hosting sin pagar de más',
                'slug' => 'como-elegir-plan-hosting',
                'excerpt' => 'Variables concretas para definir recursos, soporte y escalabilidad según tu negocio.',
                'content' => 'Primero identificá tráfico esperado, tipo de aplicación y criticidad operativa. Luego compará límites reales de CPU, memoria, almacenamiento y políticas de soporte. Fijate también si incluyen backups verificables y protección contra ataques comunes. Un plan barato sin soporte técnico termina saliendo caro cuando aparece un problema serio.',
                'status' => 'publicado',
                'reading_time_minutes' => 4,
            ],
            [
                'category_slug' => 'desarrollo-a-medida',
                'title' => 'Cuándo conviene desarrollar a medida y cuándo no',
                'slug' => 'cuando-conviene-desarrollar-a-medida',
                'excerpt' => 'Te ayudamos a evaluar si una solución custom realmente aporta ventaja competitiva.',
                'content' => 'Desarrollar a medida tiene sentido cuando el proceso de negocio es diferencial y no encaja en herramientas genéricas. Si necesitás integración compleja o reglas específicas, una plataforma propia puede escalar mejor. Ahora, para necesidades estándar, conviene evaluar soluciones existentes y personalizar lo justo. La decisión correcta equilibra costo inicial, flexibilidad y velocidad de implementación.',
                'status' => 'publicado',
                'reading_time_minutes' => 6,
            ],
            [
                'category_slug' => 'seguridad-web',
                'title' => 'Borrador interno: política de respuesta ante incidentes',
                'slug' => 'borrador-politica-respuesta-incidentes',
                'excerpt' => 'Documento en construcción para ordenar tiempos y responsables en un incidente de seguridad.',
                'content' => 'Este borrador define niveles de severidad, tiempos máximos de respuesta y responsables por área. Se usa para entrenamientos internos y no está publicado aún porque sigue en revisión legal y técnica. Al finalizar, incluirá una matriz de comunicación para clientes y un checklist de recuperación post-incidente. También contempla simulacros trimestrales para validar el protocolo.',
                'status' => 'borrador',
                'reading_time_minutes' => 7,
            ],
        ];

        foreach ($posts as $index => $postData) {
            $category = Category::query()->where('slug', $postData['category_slug'])->firstOrFail();

            Post::query()->updateOrCreate(
                ['slug' => $postData['slug']],
                [
                    'user_id' => $admin->id,
                    'category_id' => $category->id,
                    'title' => $postData['title'],
                    'excerpt' => $postData['excerpt'],
                    'content' => $postData['content'],
                    'status' => $postData['status'],
                    'reading_time_minutes' => $postData['reading_time_minutes'],
                    'published_at' => $postData['status'] === 'publicado' ? now()->subDays($index + 1) : null,
                ]
            );
        }
    }
}
