<?php

namespace App\Http\Requests\Receta;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecetaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'          => 'required|string|max:255',
            'preparacion'     => 'nullable|string',
            'tiempo_prep_min' => 'nullable|integer',
            'raciones'        => 'required|integer|min:1',
            'tipo_comida'     => 'required|in:comida,cena,ambas',
            'apta_taper'      => 'boolean',
            'apta_congelar'   => 'boolean',
            'genera_sobras'   => 'boolean',
            'raciones_sobra'  => 'integer|min:0',
            'ingredientes'    => 'nullable|array',
            'ingredientes.*.ingrediente_id' => 'required|exists:ingredientes,id',
            'ingredientes.*.cantidad'       => 'nullable|numeric',
            'ingredientes.*.unidad'         => 'nullable|string',
            'ingredientes.*.notas'          => 'nullable|string',
        ];
    }
}
