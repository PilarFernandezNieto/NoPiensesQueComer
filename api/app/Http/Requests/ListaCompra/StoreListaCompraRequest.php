<?php

namespace App\Http\Requests\ListaCompra;

use Illuminate\Foundation\Http\FormRequest;

class StoreListaCompraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'menu_semanal_id' => 'required|exists:menus_semanales,id',
        ];
    }
}
