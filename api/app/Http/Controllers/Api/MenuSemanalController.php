<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuSemanal\StoreMenuSemanalRequest;
use App\Http\Requests\MenuSemanal\UpdateMenuSemanalRequest;
use App\Http\Resources\MenuSemanalResource;
use App\Models\MenuSemanal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuSemanalController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $menus = MenuSemanal::where('hogar_id', $request->user()->hogar_id)
            ->orderBy('semana_inicio', 'desc')
            ->get();

        return response()->json(MenuSemanalResource::collection($menus));
    }

    public function store(StoreMenuSemanalRequest $request): JsonResponse
    {
        $menu = MenuSemanal::create([
            'hogar_id'      => $request->user()->hogar_id,
            'semana_inicio' => $request->semana_inicio,
            'estado'        => 'borrador',
            'generado_en'   => now(),
        ]);

        return response()->json(MenuSemanalResource::make($menu), 201);
    }

    public function show(Request $request, MenuSemanal $menuSemanal): JsonResponse
    {
        if ($menuSemanal->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        return response()->json(MenuSemanalResource::make($menuSemanal->load('slots.receta')));
    }

    public function update(UpdateMenuSemanalRequest $request, MenuSemanal $menuSemanal): JsonResponse
    {
        if ($menuSemanal->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        if ($request->estado === 'aceptado') {
            $menuSemanal->update([
                'estado'      => 'aceptado',
                'aceptado_en' => now(),
            ]);
        } else {
            $menuSemanal->update($request->only('estado'));
        }

        return response()->json(MenuSemanalResource::make($menuSemanal));
    }

    public function destroy(Request $request, MenuSemanal $menuSemanal): JsonResponse
    {
        if ($menuSemanal->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        $menuSemanal->delete();

        return response()->json(['mensaje' => 'Menú eliminado correctamente.']);
    }
}
