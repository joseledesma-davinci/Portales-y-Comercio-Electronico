<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateDatabase extends Command
{
    /**
     * Nombre y firma del comando.
     *
     * @var string
     */
    protected $signature = 'db:create';

    /**
     * Descripción visible en artisan list.
     *
     * @var string
     */
    protected $description = 'Crea automáticamente la base MySQL definida en DB_DATABASE (si no existe).';

    /**
     * Ejecuta el comando.
     */
    public function handle(): int
    {
        $defaultConnection = (string) Config::get('database.default');

        if ($defaultConnection !== 'mysql') {
            $this->warn('La conexión actual no es MySQL. Este comando solo aplica a conexiones MySQL.');
            $this->line('No se realizó ninguna acción sobre la base de datos.');

            return self::SUCCESS;
        }

        $databaseName = (string) Config::get('database.connections.mysql.database', '');

        if ($databaseName === '') {
            $this->error('DB_DATABASE está vacío. Configurá el .env con un nombre de base válido e intentá nuevamente.');

            return self::FAILURE;
        }

        // Defensa simple para el oral: solo permitimos letras, números y guion bajo.
        // Evita nombres inesperados y reduce riesgo de inyección al construir SQL dinámico.
        if (! preg_match('/^[A-Za-z0-9_]+$/', $databaseName)) {
            $this->error('El nombre de DB_DATABASE contiene caracteres inválidos. Usá solo letras, números y guion bajo.');

            return self::FAILURE;
        }

        $originalMysqlConfig = Config::get('database.connections.mysql');

        if (! is_array($originalMysqlConfig)) {
            $this->error('No se encontró configuración válida para la conexión mysql en config/database.php.');

            return self::FAILURE;
        }

        try {
            // Para crear la base, conectamos al servidor sin seleccionar una base concreta.
            // Esto permite ejecutar CREATE DATABASE incluso cuando la DB objetivo aún no existe.
            $configWithoutDatabase = $originalMysqlConfig;
            $configWithoutDatabase['database'] = null;

            Config::set('database.connections.mysql', $configWithoutDatabase);

            // Purge fuerza a Laravel a descartar conexiones cacheadas y reabrir con la config nueva.
            DB::purge('mysql');

            // IF NOT EXISTS vuelve idempotente el comando: se puede correr varias veces sin romper.
            DB::connection('mysql')->statement(
                sprintf(
                    'CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci',
                    $databaseName
                )
            );

            $this->info(sprintf(
                'Base de datos `%s` creada o ya existente (utf8mb4 / utf8mb4_unicode_ci).',
                $databaseName
            ));
        } catch (Throwable $exception) {
            $this->error('No se pudo crear la base de datos MySQL. Verificá servidor, host, puerto y credenciales del .env.');
            $this->line('Detalle técnico: '.$exception->getMessage());

            return self::FAILURE;
        } finally {
            // Restauramos SIEMPRE la configuración original para que migrate/seed sigan funcionando normal.
            Config::set('database.connections.mysql', $originalMysqlConfig);
            DB::purge('mysql');
        }

        return self::SUCCESS;
    }
}
