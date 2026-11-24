<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Seeder de suscripciones usuario-servicio para pruebas del panel admin.
 */
class SubscriptionSeeder extends Seeder
{
    /**
     * Carga contratos de ejemplo con estados variados y fechas coherentes.
     */
    public function run(): void
    {
        $maria = User::query()->where('email', 'maria@estudio.test')->firstOrFail();
        $lucas = User::query()->where('email', 'lucas@estudio.test')->firstOrFail();
        $sofia = User::query()->where('email', 'sofia@estudio.test')->firstOrFail();

        $hostingPro = Service::query()->where('title', 'Hosting Pro')->firstOrFail();
        $mantenimiento = Service::query()->where('title', 'Mantenimiento Mensual')->firstOrFail();
        $rediseno = Service::query()->where('title', 'Diseño y Rediseño Web')->firstOrFail();

        $subscriptions = [
            [
                'user_id' => $maria->id,
                'service_id' => $hostingPro->id,
                'status' => 'activa',
                'started_at' => '2026-07-01',
                'expires_at' => '2027-07-01',
                'notes' => 'Renovación anual con soporte prioritario.',
            ],
            [
                'user_id' => $lucas->id,
                'service_id' => $mantenimiento->id,
                'status' => 'vencida',
                'started_at' => '2025-04-15',
                'expires_at' => '2026-04-15',
                'notes' => 'Contrato pausado hasta nueva campaña.',
            ],
            [
                'user_id' => $sofia->id,
                'service_id' => $rediseno->id,
                'status' => 'activa',
                'started_at' => '2026-09-10',
                'expires_at' => null,
                'notes' => 'Proyecto por etapas con revisión trimestral.',
            ],
        ];

        foreach ($subscriptions as $subscription) {
            Subscription::query()->updateOrCreate(
                [
                    'user_id' => $subscription['user_id'],
                    'service_id' => $subscription['service_id'],
                    'started_at' => $subscription['started_at'],
                ],
                $subscription,
            );
        }
    }
}
