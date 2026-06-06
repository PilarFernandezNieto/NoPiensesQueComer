<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredienteRecetaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'ingrediente_id' => $this->ingrediente_id,
            'cantidad'       => $this->cantidad,
            'unidad'         => $this->unidad,
            'notas'          => $this->notas,
            'ingrediente'    => IngredienteResource::make($this->whenLoaded('ingrediente')),
        ];
    }
}
