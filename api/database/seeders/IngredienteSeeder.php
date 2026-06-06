<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingrediente;
use App\Models\CategoriaIngrediente;
use Illuminate\Support\Str;

class IngredienteSeeder extends Seeder
{
    public function run(): void
    {
        $ingredientes = [
            'Proteínas' => [
                'Pollo',
                'Huevos',
                'Atún',
                'Merluza',
                'Salmón',
                'Carne picada',
                'Cerdo',
                'Jamón serrano',
                'Bacon',
                'Gambas',
                'Sardinas',
            ],
            'Bases' => [
                'Arroz',
                'Pasta',
                'Quinoa',
                'Patata',
                'Pan',
                'Lentejas',
                'Garbanzos',
                'Fréjoles',
                'Alubias',
            ],
            'Verduras' => [
                'Tomate',
                'Pepino',
                'Calabacín',
                'Zanahoria',
                'Pimiento rojo',
                'Pimiento verde',
                'Cebolla',
                'Ajo',
                'Lechuga',
                'Espinacas',
                'Berenjena',
                'Alcachofa',
                'Brócoli',
                'Coliflor',
                'Puerro',
            ],
            'Lácteos' => [
                'Queso',
                'Leche',
                'Nata',
                'Mantequilla',
                'Yogur',
            ],
            'Conservas' => [
                'Tomate frito',
                'Tomate natural triturado',
                'Aceitunas',
                'Maíz',
                'Pimientos del piquillo',
            ],
            'Condimentos' => [
                'Aceite de oliva',
                'Sal',
                'Pimienta',
                'Pimentón',
                'Comino',
                'Orégano',
                'Perejil',
                'Laurel',
                'Vinagre',
            ],
            'Frescos' => [
                'Limón',
                'Naranja',
                'Manzana',
            ],
        ];

        foreach ($ingredientes as $categoria => $nombres) {
            $cat = CategoriaIngrediente::where('nombre', $categoria)->first();
            if (!$cat) continue;

            foreach ($nombres as $nombre) {
                Ingrediente::firstOrCreate(
                    ['slug' => Str::slug($nombre)],
                    [
                        'categoria_id' => $cat->id,
                        'nombre'       => $nombre,
                        'es_sistema'   => true,
                    ]
                );
            }
        }
    }
}
