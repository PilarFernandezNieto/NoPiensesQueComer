<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestriccionIngredienteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'hogar_id'       => $this->hogar_id,
            'ingrediente_id' => $this->ingrediente_id,
            'ambito'         => $this->ambito,
            'notas'          => $this->notas,
            'ingrediente'    => IngredienteResource::make($this->whenLoaded('ingrediente')),
        ];
    }
}
