<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuSemanalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'hogar_id'       => $this->hogar_id,
            'semana_inicio'  => $this->semana_inicio,
            'estado'         => $this->estado,
            'generado_en'    => $this->generado_en,
            'aceptado_en'    => $this->aceptado_en,
            'slots'          => SlotMenuResource::collection($this->whenLoaded('slots')),
        ];
    }
}
