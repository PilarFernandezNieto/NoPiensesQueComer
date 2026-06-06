<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaIngrediente\StoreCategoriaIngredienteRequest;
use App\Http\Requests\CategoriaIngrediente\UpdateCategoriaIngredienteRequest;
use App\Http\Resources\CategoriaIngredienteResource;
use App\Models\CategoriaIngrediente;
use Illuminate\Http\JsonResponse;

class CategoriaIngredienteController extends Controller
{
    public function index(): JsonResponse
    {
        $categorias = CategoriaIngrediente::orderBy('orden')->get();

        return response()->json(CategoriaIngredienteResource::collection($categorias));
    }

    public function store(StoreCategoriaIngredienteRequest $request): JsonResponse
    {
        $categoria = CategoriaIngrediente::create($request->only('nombre', 'orden'));

        return response()->json(CategoriaIngredienteResource::make($categoria), 201);
    }

    public function show(CategoriaIngrediente $categoriaIngrediente): JsonResponse
    {
        return response()->json(CategoriaIngredienteResource::make($categoriaIngrediente));
    }

    public function update(UpdateCategoriaIngredienteRequest $request, CategoriaIngrediente $categoriaIngrediente): JsonResponse
    {
        $categoriaIngrediente->update($request->only('nombre', 'orden'));

        return response()->json(CategoriaIngredienteResource::make($categoriaIngrediente));
    }

    public function destroy(CategoriaIngrediente $categoriaIngrediente): JsonResponse
    {
        $categoriaIngrediente->delete();

        return response()->json(['mensaje' => 'Categoría eliminada correctamente.']);
    }
}
