<?php

namespace App\Http\Requests\Hogar;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHogarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
        ];
    }
}
