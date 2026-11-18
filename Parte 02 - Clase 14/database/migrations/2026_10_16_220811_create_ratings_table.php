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
        Schema::create('ratings', function (Blueprint $table) {
            /*
                Para definir los distintos tipos de columnas INT que sean PK UNSIGNED NOT NULL y AUTO_INCREMENT
                Laravel nos ofrece los métodos de Blueprint:
                    tinyIncrements()
                    smallIncrements()
                    mediumIncrements()
                    increments()
                    bigIncrements()
            */
            $table->tinyIncrements('rating_id');
            $table->string('name', 30);
            $table->char('abbreviation', 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
