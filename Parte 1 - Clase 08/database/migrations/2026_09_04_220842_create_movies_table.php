<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
    Como podemos ver, las migraciones son clases que deben heredar de la clase Migration de Laravel.
    Suelen crearse como clases anónimas.

    Deben tener dos métodos:
    - up()
        Debe contener las instrucciones con los cambios que queremos realizar en la base de datos.
    - down()
        Debe contener las instrucciones para revertir los cambios que realizamos en el up().
*/
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
            Schema es la clase que permite ejecutar cambios en el schema de la base de datos.
            Su método create() crea una tabla recibiendo 2 parámetros:
            - String. El nombre de la tabla.
            - Callable. El código que define la estructura de la tabla. Este callable suele recibir
                un parámetro de tipo Blueprint.
            
            Blueprint (plano de construcción), por su lado, es la clase que representa la configuración 
            de una tabla.
        */
        Schema::create('movies', function (Blueprint $table) {
            /*
                Estructura deseada:
                    movies
                    ------
                    movie_id        PRIMARY BIGINT UNSIGNED NOT NULL AUTO_INCREMENT
                    title           VARCHAR(100) NOT NULL
                    price           INT UNSIGNED NOT NULL
                    release_date    DATE NOT NULL
                    synopsis        TEXT NOT NULL

                ¿Por qué INT para el precio?
                La idea es que vamos a guardar el precio en centavos.

                Si bien para un proyecto como el nuestro esto normalmente no haría una diferencia, sí
                vamos a hacerlo para aprender el por qué de esta práctica, y formas en que Laravel nos
                puede simplificar alguna que otra cosita.

                Generalmente, la razón para usar INT como valores monetarios es para asegurar una 
                precisión exacta, sobre todo al momento de realizar operaciones matemáticas.

                Como saben, las bases de datos como MySQL o MariaDB tienen tipos de datos para poder
                guardar valores numéricos con decimales. En estas dos bases de datos, en particular, 
                tenemos las opciones de FLOAT / DOUBLE y DECIMAL.

                La aritmética de enteros es exacta. Lo que la hace una opción mucho mejor para guardar
                números que requieren una alta exactitud durante las operaciones.
                Por esto, es que las entidades bancarias siempre guardan los valores monetarios como
                enteros.
            */

            /*
                El método id() define una columna de nombre "id" que sea:
                    PRIMARY KEY BIGINT UNSIGNED NOT NULL AUTO_INCREMENT
                
                Si no queremos que el campo de llame "id", lo podemos cambiar pasando el nombre por
                parámetro.

                Importante: El nombre "id" para la PK es una convención de Laravel. Respetarla nos ahorra
                trabajo en el uso del framework. Ya que no tenemos que estar configurando el nombre de la
                PK. 
                Si bien, si es posible, es recomendable aprovechar estas convenciones de Laravel, no lo 
                vamos a hacer en este ejemplo para ver cómo se manejaría en este escenario.
            */
            $table->id('movie_id');
    
            /*
                Para definir una columna VARCHAR usamos el método string().
                Si no pasamos una longitud como segundo parámetro, Laravel va a usar el default que tiene
                estipulado.
                Si no modificamos ese default, el valor es 255.
            */
            $table->string('title', 100);

            /*
                Para la mayoría de los otros tipos de dato, se definen con métodos que se llaman igual que
                el tipo de dato en MySQL / MariaDB. Por ejemplo:
                    INT => integer()
                    DATE => date()
                    DATETIME => datetime()
                    TIMESTAMP => timestamp()
                    TEXT => text()
                
                Etc.
            */
            // $table->integer('price')->unsigned();
            $table->unsignedInteger('price');
            $table->date('release_date');
            $table->text('synopsis');

            /*
                Por defecto, vamos a ver que al crear una migration para crear una tabla, Laravel nos 
                propone dos métodos automáticamente: id() y timestamps() (noten la "s" del plural).

                El método timestamps() define 2 columnas:
                    - created_at TIMESTAMP
                    - updated_at TIMESTAMP

                Que sirven para guardar la fecha de creación y de última modificación del registro,
                respectivamente.
                Si estamos usando "Eloquent", estos campos se manejan automáticamente.
            */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
