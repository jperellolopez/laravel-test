<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // añadimos una columna con su tipo de datos y entre paréntesis el nombre
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            // relación de clave foránea con el user_id de la tabla de usuarios
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('tags');
            $table->string('company');
            $table->string('location');
            $table->string('email');
            $table->string('website');
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ofertas');
    }
};
