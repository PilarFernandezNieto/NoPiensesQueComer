<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestriccionIngrediente\StoreRestriccionIngredienteRequest;
use App\Http\Requests\RestriccionIngrediente\UpdateRestriccionIngredienteRequest;
use App\Http\Resources\RestriccionIngredienteResource;
use App\Models\RestriccionIngrediente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestriccionIngredienteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $restricciones = RestriccionIngrediente::with('ingrediente')
            ->where('hogar_id', $request->user()->hogar_id)
            ->get();

        return response()->json(RestriccionIngredienteResource::collection($restricciones));
    }

    public function store(StoreRestriccionIngredienteRequest $request): JsonResponse
    {
        $restriccion = RestriccionIngrediente::create([
            'hogar_id'       => $request->user()->hogar_id,
            'ingrediente_id' => $request->ingrediente_id,
            'ambito'         => $request->ambito,
            'notas'          => $request->notas,
        ]);

        return response()->json(RestriccionIngredienteResource::make($restriccion->load('ingrediente')), 201);
    }

    public function show(Request $request, RestriccionIngrediente $restriccionIngrediente): JsonResponse
    {
        if ($restriccionIngrediente->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        return response()->json(RestriccionIngredienteResource::make($restriccionIngrediente->load('ingrediente')));
    }

    public function update(UpdateRestriccionIngredienteRequest $request, RestriccionIngrediente $restriccionIngrediente): JsonResponse
    {
        if ($restriccionIngrediente->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        $restriccionIngrediente->update($request->only('ambito', 'notas'));

        return response()->json(RestriccionIngredienteResource::make($restriccionIngrediente->load('ingrediente')));
    }

    public function destroy(Request $request, RestriccionIngrediente $restriccionIngrediente): JsonResponse
    {
        if ($restriccionIngrediente->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        $restriccionIngrediente->delete();

        return response()->json(['mensaje' => 'Restricción eliminada correctamente.']);
    }
}
