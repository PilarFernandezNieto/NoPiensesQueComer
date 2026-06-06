<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListaCompraResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'menu_semanal_id' => $this->menu_semanal_id,
            'generado_en'     => $this->generado_en,
            'items'           => ItemListaCompraResource::collection($this->whenLoaded('items')),
        ];
    }
}
