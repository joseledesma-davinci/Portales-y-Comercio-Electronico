<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies_have_genres', function (Blueprint $table) {
            /*
                # Forma alternativa para definir la FK
                Definir una FK suele requerir que primero creemos el campo, y luego llamemos a 
                    foreign(campoFK)->references(campoPK)->on(tabla)

                Eso se hace un poco largo de escribir. Y por esta razón, con el fin de simplificar un 
                poquito el proceso, Laravel ofrece también el método foreignId().

                El método foreignId() es más corto y, posiblemente, conveniente, pero solo sirve para FKs
                que referencien una PK que sea BIGINT.
            */
            $table->foreignId('movie_fk')->constrained('movies', 'movie_id');

            $table->unsignedSmallInteger('genre_fk');
            $table->foreign('genre_fk')->references('genre_id')->on('genres');

            $table->timestamps();

            $table->primary(['movie_fk', 'genre_fk']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies_have_genres');
    }
};
