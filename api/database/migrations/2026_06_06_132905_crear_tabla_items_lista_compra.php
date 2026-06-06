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
        Schema::create('items_lista_compra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lista_compra_id')->constrained('listas_compra')->cascadeOnDelete();
            $table->foreignId('ingrediente_id')->constrained('ingredientes')->cascadeOnDelete();
            $table->decimal('cantidad_total', 8, 2)->nullable();
            $table->string('unidad')->nullable();
            $table->boolean('marcado')->default(false);
            $table->integer('orden_categoria')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_lista_compra');
    }
};
