<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListaCompra\StoreListaCompraRequest;
use App\Http\Requests\ListaCompra\UpdateListaCompraRequest;
use App\Http\Resources\ListaCompraResource;
use App\Models\ItemListaCompra;
use App\Models\ListaCompra;
use App\Models\MenuSemanal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListaCompraController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $listas = ListaCompra::whereHas('menuSemanal', fn($q) => $q->where('hogar_id', $request->user()->hogar_id))
            ->with('items.ingrediente.categoria')
            ->get();

        return response()->json(ListaCompraResource::collection($listas));
    }

    public function store(StoreListaCompraRequest $request): JsonResponse
    {
        $menu = MenuSemanal::with('slots.receta.ingredientes.ingrediente.categoria')
            ->findOrFail($request->menu_semanal_id);

        if ($menu->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        $lista = ListaCompra::create([
            'menu_semanal_id' => $menu->id,
            'generado_en'     => now(),
        ]);

        $ingredientesAgrupados = [];

        foreach ($menu->slots as $slot) {
            if ($slot->es_sobra) continue;

            foreach ($slot->receta->ingredientes as $ingredienteReceta) {
                $id = $ingredienteReceta->ingrediente_id;

                if (!isset($ingredientesAgrupados[$id])) {
                    $ingredientesAgrupados[$id] = [
                        'ingrediente'    => $ingredienteReceta->ingrediente,
                        'cantidad_total' => 0,
                        'unidad'         => $ingredienteReceta->unidad,
                    ];
                }

                $ingredientesAgrupados[$id]['cantidad_total'] += $ingredienteReceta->cantidad ?? 0;
            }
        }

        $orden = 0;
        foreach ($ingredientesAgrupados as $id => $datos) {
            ItemListaCompra::create([
                'lista_compra_id' => $lista->id,
                'ingrediente_id'  => $id,
                'cantidad_total'  => $datos['cantidad_total'] > 0 ? $datos['cantidad_total'] : null,
                'unidad'          => $datos['unidad'],
                'marcado'         => false,
                'orden_categoria' => $datos['ingrediente']->categoria->orden ?? $orden,
            ]);
            $orden++;
        }

        return response()->json(ListaCompraResource::make($lista->load('items.ingrediente.categoria')), 201);
    }

    public function show(Request $request, ListaCompra $listaCompra): JsonResponse
    {
        if ($listaCompra->menuSemanal->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        return response()->json(ListaCompraResource::make($listaCompra->load('items.ingrediente.categoria')));
    }

    public function update(UpdateListaCompraRequest $request, ListaCompra $listaCompra): JsonResponse
    {
        if ($listaCompra->menuSemanal->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        foreach ($request->items as $item) {
            ItemListaCompra::where('id', $item['id'])->update(['marcado' => $item['marcado']]);
        }

        return response()->json(ListaCompraResource::make($listaCompra->load('items.ingrediente.categoria')));
    }

    public function destroy(Request $request, ListaCompra $listaCompra): JsonResponse
    {
        if ($listaCompra->menuSemanal->hogar_id !== $request->user()->hogar_id) {
            return response()->json(['mensaje' => 'No autorizado.'], 403);
        }

        $listaCompra->delete();

        return response()->json(['mensaje' => 'Lista de compra eliminada correctamente.']);
    }
}
