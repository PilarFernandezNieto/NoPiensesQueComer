<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemListaCompraResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'lista_compra_id' => $this->lista_compra_id,
            'ingrediente_id'  => $this->ingrediente_id,
            'cantidad_total'  => $this->cantidad_total,
            'unidad'          => $this->unidad,
            'marcado'         => $this->marcado,
            'orden_categoria' => $this->orden_categoria,
            'ingrediente'     => IngredienteResource::make($this->whenLoaded('ingrediente')),
        ];
    }
}
