<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecetaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'hogar_id'        => $this->hogar_id,
            'nombre'          => $this->nombre,
            'preparacion'     => $this->preparacion,
            'tiempo_prep_min' => $this->tiempo_prep_min,
            'raciones'        => $this->raciones,
            'tipo_comida'     => $this->tipo_comida,
            'apta_taper'      => $this->apta_taper,
            'apta_congelar'   => $this->apta_congelar,
            'genera_sobras'   => $this->genera_sobras,
            'raciones_sobra'  => $this->raciones_sobra,
            'es_sistema'      => $this->es_sistema,
            'ingredientes'    => IngredienteRecetaResource::collection($this->whenLoaded('ingredientes')),
        ];
    }
}
