<?php

namespace App\Http\Requests\Ingrediente;

use Illuminate\Foundation\Http\FormRequest;

class StoreIngredienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'categoria_id' => 'required|exists:categorias_ingredientes,id',
            'nombre'       => 'required|string|max:255',
        ];
    }
}
