<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemListaCompra extends Model
{
    protected $table = 'items_lista_compra';

    protected $fillable = [
        'lista_compra_id',
        'ingrediente_id',
        'cantidad_total',
        'unidad',
        'marcado',
        'orden_categoria',
    ];

    protected function casts(): array
    {
        return [
            'cantidad_total'  => 'decimal:2',
            'marcado'         => 'boolean',
            'orden_categoria' => 'integer',
        ];
    }

    public function listaCompra(): BelongsTo
    {
        return $this->belongsTo(ListaCompra::class);
    }

    public function ingrediente(): BelongsTo
    {
        return $this->belongsTo(Ingrediente::class);
    }
}
