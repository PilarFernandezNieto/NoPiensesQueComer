<?php

namespace App\Http\Requests\ListaCompra;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListaCompraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items'           => 'required|array',
            'items.*.id'      => 'required|exists:items_lista_compra,id',
            'items.*.marcado' => 'required|boolean',
        ];
    }
}
