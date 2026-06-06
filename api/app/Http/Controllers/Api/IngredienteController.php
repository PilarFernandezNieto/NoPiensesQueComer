<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ingrediente\StoreIngredienteRequest;
use App\Http\Requests\Ingrediente\UpdateIngredienteRequest;
use App\Http\Resources\IngredienteResource;
use App\Models\Ingrediente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IngredienteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $ingredientes = Ingrediente::with('categoria')
            ->when($request->categoria_id, fn($q) => $q->where('categoria_id', $request->categoria_id))
            ->orderBy('nombre')
            ->get();

        return response()->json(IngredienteResource::collection($ingredientes));
    }

    public function store(StoreIngredienteRequest $request): JsonResponse
    {
        $ingrediente = Ingrediente::create([
            'categoria_id' => $request->categoria_id,
            'nombre'       => $request->nombre,
            'slug'         => Str::slug($request->nombre),
            'es_sistema'   => false,
        ]);

        return response()->json(IngredienteResource::make($ingrediente->load('categoria')), 201);
    }

    public function show(Ingrediente $ingrediente): JsonResponse
    {
        return response()->json(IngredienteResource::make($ingrediente->load('categoria')));
    }

    public function update(UpdateIngredienteRequest $request, Ingrediente $ingrediente): JsonResponse
    {
        $datos = $request->only('categoria_id', 'nombre');

        if (isset($datos['nombre'])) {
            $datos['slug'] = Str::slug($datos['nombre']);
        }

        $ingrediente->update($datos);

        return response()->json(IngredienteResource::make($ingrediente->load('categoria')));
    }

    public function destroy(Ingrediente $ingrediente): JsonResponse
    {
        if ($ingrediente->es_sistema) {
            return response()->json(['mensaje' => 'No se puede eliminar un ingrediente del sistema.'], 403);
        }

        $ingrediente->delete();

        return response()->json(['mensaje' => 'Ingrediente eliminado correctamente.']);
    }
}
