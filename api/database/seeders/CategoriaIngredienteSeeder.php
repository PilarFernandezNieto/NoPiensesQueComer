<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriaIngrediente;

class CategoriaIngredienteSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Proteínas',   'orden' => 1],
            ['nombre' => 'Bases',       'orden' => 2],
            ['nombre' => 'Verduras',    'orden' => 3],
            ['nombre' => 'Lácteos',     'orden' => 4],
            ['nombre' => 'Conservas',   'orden' => 5],
            ['nombre' => 'Condimentos', 'orden' => 6],
            ['nombre' => 'Frescos',     'orden' => 7],
        ];

        foreach ($categorias as $categoria) {
            CategoriaIngrediente::firstOrCreate(
                ['nombre' => $categoria['nombre']],
                ['orden'  => $categoria['orden']]
            );
        }
    }
}
