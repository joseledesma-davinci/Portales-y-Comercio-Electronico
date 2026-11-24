<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla de publicaciones del blog.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table): void {
            $table->id();
            // Si se elimina un usuario, sus posts no deben quedar huérfanos.
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Si una categoría tiene posts, no permitimos borrarla para no perder clasificación histórica.
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->string('title', 120);
            $table->string('synopsis', 240);
            $table->longText('content');
            $table->string('image', 100)->nullable();
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla de publicaciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
