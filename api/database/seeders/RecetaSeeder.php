<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Receta;
use App\Models\Ingrediente;

class RecetaSeeder extends Seeder
{
    public function run(): void
    {
        $recetas = [
            [
                'nombre'          => 'Tortilla de patatas',
                'preparacion'     => 'Pelar y cortar las patatas en láminas finas. Freír en aceite abundante hasta que estén blandas. Batir los huevos, mezclar con las patatas escurridas y cuajar en la sartén por ambos lados.',
                'tiempo_prep_min' => 30,
                'raciones'        => 4,
                'tipo_comida'     => 'ambas',
                'apta_taper'      => true,
                'apta_congelar'   => false,
                'genera_sobras'   => true,
                'raciones_sobra'  => 2,
                'es_sistema'      => true,
                'ingredientes'    => ['Huevos', 'Patata', 'Cebolla', 'Aceite de oliva', 'Sal'],
            ],
            [
                'nombre'          => 'Pollo al horno',
                'preparacion'     => 'Marinar el pollo con ajo, pimentón, aceite y sal. Hornear a 200°C durante 45 minutos hasta que esté dorado.',
                'tiempo_prep_min' => 50,
                'raciones'        => 4,
                'tipo_comida'     => 'ambas',
                'apta_taper'      => true,
                'apta_congelar'   => true,
                'genera_sobras'   => true,
                'raciones_sobra'  => 2,
                'es_sistema'      => true,
                'ingredientes'    => ['Pollo', 'Ajo', 'Pimentón', 'Aceite de oliva', 'Sal'],
            ],
            [
                'nombre'          => 'Pasta con carne picada y tomate',
                'preparacion'     => 'Sofreír la cebolla y el ajo. Añadir la carne picada y dorar. Incorporar el tomate triturado y cocinar 15 minutos. Cocer la pasta y mezclar con la salsa.',
                'tiempo_prep_min' => 30,
                'raciones'        => 4,
                'tipo_comida'     => 'ambas',
                'apta_taper'      => true,
                'apta_congelar'   => true,
                'genera_sobras'   => true,
                'raciones_sobra'  => 2,
                'es_sistema'      => true,
                'ingredientes'    => ['Pasta', 'Carne picada', 'Tomate natural triturado', 'Cebolla', 'Ajo', 'Aceite de oliva', 'Sal'],
            ],
            [
                'nombre'          => 'Ensalada de garbanzos',
                'preparacion'     => 'Mezclar los garbanzos cocidos con tomate, pepino, pimiento y cebolla en dados. Aliñar con aceite, vinagre y sal.',
                'tiempo_prep_min' => 10,
                'raciones'        => 2,
                'tipo_comida'     => 'cena',
                'apta_taper'      => false,
                'apta_congelar'   => false,
                'genera_sobras'   => false,
                'raciones_sobra'  => 0,
                'es_sistema'      => true,
                'ingredientes'    => ['Garbanzos', 'Tomate', 'Pepino', 'Pimiento verde', 'Cebolla', 'Aceite de oliva', 'Vinagre', 'Sal'],
            ],
            [
                'nombre'          => 'Merluza al horno',
                'preparacion'     => 'Colocar los filetes de merluza en una bandeja. Añadir ajo laminado, perejil, aceite y sal. Hornear a 180°C durante 15 minutos.',
                'tiempo_prep_min' => 20,
                'raciones'        => 2,
                'tipo_comida'     => 'ambas',
                'apta_taper'      => false,
                'apta_congelar'   => false,
                'genera_sobras'   => false,
                'raciones_sobra'  => 0,
                'es_sistema'      => true,
                'ingredientes'    => ['Merluza', 'Ajo', 'Perejil', 'Aceite de oliva', 'Sal'],
            ],
            [
                'nombre'          => 'Arroz con pollo',
                'preparacion'     => 'Sofreír el pollo troceado con cebolla y pimiento. Añadir el arroz, caldo y cocinar 20 minutos.',
                'tiempo_prep_min' => 40,
                'raciones'        => 4,
                'tipo_comida'     => 'comida',
                'apta_taper'      => true,
                'apta_congelar'   => false,
                'genera_sobras'   => true,
                'raciones_sobra'  => 2,
                'es_sistema'      => true,
                'ingredientes'    => ['Arroz', 'Pollo', 'Cebolla', 'Pimiento rojo', 'Ajo', 'Aceite de oliva', 'Sal', 'Pimentón'],
            ],
            [
                'nombre'          => 'Salmorejo',
                'preparacion'     => 'Triturar el tomate con el pan remojado, ajo, aceite y sal hasta obtener una crema fina. Servir frío con huevo duro y jamón.',
                'tiempo_prep_min' => 15,
                'raciones'        => 4,
                'tipo_comida'     => 'ambas',
                'apta_taper'      => true,
                'apta_congelar'   => false,
                'genera_sobras'   => true,
                'raciones_sobra'  => 2,
                'es_sistema'      => true,
                'ingredientes'    => ['Tomate', 'Pan', 'Ajo', 'Aceite de oliva', 'Sal', 'Huevos', 'Jamón serrano'],
            ],
            [
                'nombre'          => 'Lentejas con verduras',
                'preparacion'     => 'Sofreír cebolla, zanahoria y pimiento. Añadir las lentejas, pimentón, laurel y agua. Cocinar 30 minutos a fuego medio.',
                'tiempo_prep_min' => 40,
                'raciones'        => 4,
                'tipo_comida'     => 'cena',
                'apta_taper'      => false,
                'apta_congelar'   => true,
                'genera_sobras'   => true,
                'raciones_sobra'  => 2,
                'es_sistema'      => true,
                'ingredientes'    => ['Lentejas', 'Cebolla', 'Zanahoria', 'Pimiento verde', 'Ajo', 'Pimentón', 'Laurel', 'Aceite de oliva', 'Sal'],
            ],
            [
                'nombre'          => 'Ensaladilla rusa',
                'preparacion'     => 'Cocer las patatas, zanahorias y huevos. Mezclar con atún, aceitunas y mayonesa.',
                'tiempo_prep_min' => 30,
                'raciones'        => 4,
                'tipo_comida'     => 'ambas',
                'apta_taper'      => true,
                'apta_congelar'   => false,
                'genera_sobras'   => true,
                'raciones_sobra'  => 2,
                'es_sistema'      => true,
                'ingredientes'    => ['Patata', 'Zanahoria', 'Huevos', 'Atún', 'Aceitunas', 'Sal'],
            ],
            [
                'nombre'          => 'Calabacín relleno',
                'preparacion'     => 'Vaciar los calabacines y rellenar con carne picada sofrita con tomate y cebolla. Gratinar con queso.',
                'tiempo_prep_min' => 40,
                'raciones'        => 2,
                'tipo_comida'     => 'cena',
                'apta_taper'      => false,
                'apta_congelar'   => false,
                'genera_sobras'   => false,
                'raciones_sobra'  => 0,
                'es_sistema'      => true,
                'ingredientes'    => ['Calabacín', 'Carne picada', 'Tomate natural triturado', 'Cebolla', 'Queso', 'Aceite de oliva', 'Sal'],
            ],
        ];

        foreach ($recetas as $datos) {
            $ingredientes = $datos['ingredientes'];
            unset($datos['ingredientes']);

            $receta = Receta::firstOrCreate(
                ['nombre' => $datos['nombre'], 'hogar_id' => null],
                $datos
            );

            foreach ($ingredientes as $nombreIngrediente) {
                $ingrediente = Ingrediente::where('nombre', $nombreIngrediente)->first();
                if (!$ingrediente) continue;

                $receta->ingredientes()->firstOrCreate(
                    ['ingrediente_id' => $ingrediente->id]
                );
            }
        }
    }
}
