<?php

namespace App\Http\Requests\SlotMenu;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSlotMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'receta_id' => 'exists:recetas,id',
            'bloqueado' => 'boolean',
            'raciones'  => 'integer|min:1',
        ];
    }
}
