<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlotMenu\IndexSlotMenuRequest;
use App\Http\Requests\SlotMenu\StoreSlotMenuRequest;
use App\Http\Requests\SlotMenu\UpdateSlotMenuRequest;
use App\Http\Resources\SlotMenuResource;
use App\Models\SlotMenu;
use Illuminate\Http\JsonResponse;

class SlotMenuController extends Controller
{
    public function index(IndexSlotMenuRequest $request): JsonResponse
    {
        $slots = SlotMenu::with('receta')
            ->where('menu_semanal_id', $request->menu_semanal_id)
            ->orderBy('dia_semana')
            ->orderBy('tipo_comida')
            ->get();

        return response()->json(SlotMenuResource::collection($slots));
    }

    public function store(StoreSlotMenuRequest $request): JsonResponse
    {
        $slot = SlotMenu::create($request->validated());

        return response()->json(SlotMenuResource::make($slot->load('receta')), 201);
    }

    public function show(SlotMenu $slotMenu): JsonResponse
    {
        return response()->json(SlotMenuResource::make($slotMenu->load('receta')));
    }

    public function update(UpdateSlotMenuRequest $request, SlotMenu $slotMenu): JsonResponse
    {
        $slotMenu->update($request->only('receta_id', 'bloqueado', 'raciones'));

        return response()->json(SlotMenuResource::make($slotMenu->load('receta')));
    }

    public function destroy(SlotMenu $slotMenu): JsonResponse
    {
        $slotMenu->delete();

        return response()->json(['mensaje' => 'Slot eliminado correctamente.']);
    }
}
