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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('postulante_id')->nullable(); // Asegúrate de que esta columna es unsigned
            $table->string('cedula');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('mail');
            $table->string('num1');
            $table->string('num2');
            $table->string('num3')->nullable();
            $table->text('tipp');
            $table->text('notas')->nullable();
            $table->timestamps();

            // Definición de la clave foránea para la relación con postulantes
            $table->foreign('postulante_id')->references('id')->on('postulantes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
