<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Receta\StoreRecetaRequest;
use App\Http\Requests\Receta\UpdateRecetaRequest;
use App\Http\Resources\RecetaResource;
use App\Models\Receta;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $recetas = Receta::with('ingredientes.ingrediente')
            ->where(function ($q) use ($request) {
                $q->whereNull('hogar_id')
                    ->orWhere('hogar_id', $request->user()->hogar_id);
            })
            ->when($request->tipo_comida, fn($q) => $q->where('tipo_comida', $request->tipo_comida))
            ->when($request->apta_taper, fn($q) => $q->where('apta_taper', true))
            ->orderBy('nombre')
            ->get();

        return response()->json(RecetaResource::collection($recetas));
    }

    public function store(StoreRecetaRequest $request): JsonResponse
    {
        $receta = Receta::create([
            'hogar_id'        => $request->user()->hogar_id,
            'nombre'          => $request->nombre,
            'preparacion'     => $request->preparacion,
            'tiempo_prep_min' => $request->tiempo_prep_min,
            'raciones'        => $request->raciones,
            'tipo_comida'     => $request->tipo_comida,
            'apta_taper'      => $request->apta_taper ?? true,
            'apta_congelar'   => $request->apta_congelar ?? false,
            'genera_sobras'   => $request->genera_sobras ?? false,
            'raciones_sobra'  => $request->raciones_sobra ?? 0,
            'es_sistema'      => false,
        ]);

        if ($request->has('ingredientes')) {
            foreach ($request->ingredientes as $ingrediente) {
                $receta->ingredientes()->create($ingrediente);
            }
        }

        return response()->json(RecetaResource::make($receta->load('ingredientes.ingrediente')), 201);
    }

    public function show(Request $request, Receta $receta): JsonResponse
    {
        if ($receta->hogar_id && $receta->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        return response()->json(RecetaResource::make($receta->load('ingredientes.ingrediente')));
    }

    public function update(UpdateRecetaRequest $request, Receta $receta): JsonResponse
    {
        if ($receta->es_sistema) {
            return response()->json(['mensaje' => 'No se puede editar una receta del sistema.'], 403);
        }

        if ($receta->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        $receta->update($request->except('ingredientes'));

        if ($request->has('ingredientes')) {
            $receta->ingredientes()->delete();
            foreach ($request->ingredientes as $ingrediente) {
                $receta->ingredientes()->create($ingrediente);
            }
        }

        return response()->json(RecetaResource::make($receta->load('ingredientes.ingrediente')));
    }

    public function destroy(Request $request, Receta $receta): JsonResponse
    {
        if ($receta->es_sistema) {
            return response()->json(['mensaje' => 'No se puede eliminar una receta del sistema.'], 403);
        }

        if ($receta->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        $receta->delete();

        return response()->json(['mensaje' => 'Receta eliminada correctamente.']);
    }
}
