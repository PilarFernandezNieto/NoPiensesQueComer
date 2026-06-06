<?php

namespace App\Http\Requests\MenuSemanal;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuSemanalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'estado' => 'in:borrador,aceptado',
        ];
    }
}
