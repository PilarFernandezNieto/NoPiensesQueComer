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
        Schema::create('slots_menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_semanal_id')->constrained('menus_semanales')->cascadeOnDelete();
            $table->foreignId('receta_id')->constrained('recetas')->cascadeOnDelete();
            $table->tinyInteger('dia_semana')->comment('0=lunes, 6=domingo');
            $table->enum('tipo_comida', ['comida', 'cena']);
            $table->boolean('es_sobra')->default(false);
            $table->foreignId('slot_origen_id')->nullable()->constrained('slots_menu')->nullOnDelete();
            $table->boolean('bloqueado')->default(false);
            $table->integer('raciones')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots_menu');
    }
};
