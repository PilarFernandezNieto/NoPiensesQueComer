<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredienteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'nombre'       => $this->nombre,
            'slug'         => $this->slug,
            'es_sistema'   => $this->es_sistema,
            'categoria_id' => $this->categoria_id,
            'categoria'    => CategoriaIngredienteResource::make($this->whenLoaded('categoria')),
        ];
    }
}
