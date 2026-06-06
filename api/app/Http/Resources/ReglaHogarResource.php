<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReglaHogarResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'hogar_id'   => $this->hogar_id,
            'tipo'       => $this->tipo,
            'dia_semana' => $this->dia_semana,
            'valor'      => $this->valor,
            'notas'      => $this->notas,
        ];
    }
}
