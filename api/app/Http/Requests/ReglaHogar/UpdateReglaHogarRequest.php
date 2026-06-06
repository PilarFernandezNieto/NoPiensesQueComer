<?php

namespace App\Http\Requests\ReglaHogar;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReglaHogarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo'       => 'in:dia_sin_cocina,taper_requerido,max_dias_cocina',
            'dia_semana' => 'nullable|integer|min:0|max:6',
            'valor'      => 'nullable|string',
            'notas'      => 'nullable|string',
        ];
    }
}
