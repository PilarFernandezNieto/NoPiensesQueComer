<?php

namespace App\Http\Requests\RestriccionIngrediente;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestriccionIngredienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ingrediente_id' => 'required|exists:ingredientes,id',
            'ambito'         => 'required|in:siempre,solo_comida,solo_cena',
            'notas'          => 'nullable|string',
        ];
    }
}
