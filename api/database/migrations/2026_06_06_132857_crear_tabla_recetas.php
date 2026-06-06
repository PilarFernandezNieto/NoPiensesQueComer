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
        Schema::create(
            'recetas',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('hogar_id')->nullable();
                $table->foreign('hogar_id')->references('id')->on('hogares')->nullOnDelete();
                $table->string('nombre');
                $table->text('preparacion')->nullable();
                $table->integer('tiempo_prep_min')->nullable();
                $table->integer('raciones')->default(2);
                $table->enum('tipo_comida', ['comida', 'cena', 'ambas'])->default('comida');
                $table->boolean('apta_taper')->default(true);
                $table->boolean('apta_congelar')->default(true);
                $table->boolean('genera_sobras')->default(false);
                $table->integer('raciones_sobra')->default(0);
                $table->boolean('es_sistema')->default(false);
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recetas');
    }
};
