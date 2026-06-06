<?php

namespace App\Http\Requests\MenuSemanal;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuSemanalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'semana_inicio' => 'required|date',
        ];
    }
}
