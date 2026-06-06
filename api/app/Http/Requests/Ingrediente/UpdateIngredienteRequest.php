<?php

namespace App\Http\Requests\Ingrediente;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIngredienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'categoria_id' => 'exists:categorias_ingredientes,id',
            'nombre'       => 'string|max:255',
        ];
    }
}
