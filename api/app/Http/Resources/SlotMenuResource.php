<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlotMenuResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'menu_semanal_id' => $this->menu_semanal_id,
            'receta_id'       => $this->receta_id,
            'dia_semana'      => $this->dia_semana,
            'tipo_comida'     => $this->tipo_comida,
            'es_sobra'        => $this->es_sobra,
            'slot_origen_id'  => $this->slot_origen_id,
            'bloqueado'       => $this->bloqueado,
            'raciones'        => $this->raciones,
            'receta'          => RecetaResource::make($this->whenLoaded('receta')),
        ];
    }
}
