<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla relación entre usuarios y servicios contratados.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table): void {
            $table->id();
            // Si un usuario se elimina del sistema, sus contratos deben borrarse junto con su cuenta.
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Si un servicio está contratado, se bloquea su baja para no romper historial comercial.
            $table->foreignId('service_id')->constrained()->restrictOnDelete();
            $table->enum('status', ['activa', 'vencida', 'cancelada'])->default('activa');
            $table->date('started_at');
            $table->date('expires_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla de suscripciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
