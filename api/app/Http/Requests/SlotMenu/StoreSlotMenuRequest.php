<?php

namespace App\Http\Requests\SlotMenu;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlotMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'menu_semanal_id' => 'required|exists:menus_semanales,id',
            'receta_id'       => 'required|exists:recetas,id',
            'dia_semana'      => 'required|integer|min:0|max:6',
            'tipo_comida'     => 'required|in:comida,cena',
            'es_sobra'        => 'boolean',
            'slot_origen_id'  => 'nullable|exists:slots_menu,id',
            'bloqueado'       => 'boolean',
            'raciones'        => 'integer|min:1',
        ];
    }
}
