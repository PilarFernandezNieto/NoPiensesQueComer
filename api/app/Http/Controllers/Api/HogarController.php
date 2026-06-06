<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hogar\UpdateHogarRequest;
use App\Http\Resources\HogarResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HogarController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json(HogarResource::make($request->user()->hogar));
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json(['mensaje' => 'No permitido.'], 403);
    }

    public function show(Request $request): JsonResponse
    {
        return response()->json(HogarResource::make($request->user()->hogar));
    }

    public function update(UpdateHogarRequest $request): JsonResponse
    {
        $hogar = $request->user()->hogar;
        $hogar->update($request->only('nombre'));

        return response()->json(HogarResource::make($hogar));
    }

    public function destroy(Request $request): JsonResponse
    {
        return response()->json(['mensaje' => 'No permitido.'], 403);
    }
}
