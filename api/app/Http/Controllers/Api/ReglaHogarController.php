<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReglaHogar\StoreReglaHogarRequest;
use App\Http\Requests\ReglaHogar\UpdateReglaHogarRequest;
use App\Http\Resources\ReglaHogarResource;
use App\Models\ReglaHogar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReglaHogarController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $reglas = ReglaHogar::where('hogar_id', $request->user()->hogar_id)->get();

        return response()->json(ReglaHogarResource::collection($reglas));
    }

    public function store(StoreReglaHogarRequest $request): JsonResponse
    {
        $regla = ReglaHogar::create([
            'hogar_id'   => $request->user()->hogar_id,
            'tipo'       => $request->tipo,
            'dia_semana' => $request->dia_semana,
            'valor'      => $request->valor,
            'notas'      => $request->notas,
        ]);

        return response()->json(ReglaHogarResource::make($regla), 201);
    }

    public function show(Request $request, ReglaHogar $reglaHogar): JsonResponse
    {
        if ($reglaHogar->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        return response()->json(ReglaHogarResource::make($reglaHogar));
    }

    public function update(UpdateReglaHogarRequest $request, ReglaHogar $reglaHogar): JsonResponse
    {
        if ($reglaHogar->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        $reglaHogar->update($request->only('tipo', 'dia_semana', 'valor', 'notas'));

        return response()->json(ReglaHogarResource::make($reglaHogar));
    }

    public function destroy(Request $request, ReglaHogar $reglaHogar): JsonResponse
    {
        if ($reglaHogar->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        $reglaHogar->delete();

        return response()->json(['mensaje' => 'Regla eliminada correctamente.']);
    }
}
