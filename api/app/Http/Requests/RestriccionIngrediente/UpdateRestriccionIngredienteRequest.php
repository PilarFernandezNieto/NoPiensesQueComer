<?php

namespace App\Http\Requests\RestriccionIngrediente;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestriccionIngredienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ambito' => 'in:siempre,solo_comida,solo_cena',
            'notas'  => 'nullable|string',
        ];
    }
}
